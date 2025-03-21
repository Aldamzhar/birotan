<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use NcJoes\OfficeConverter\OfficeConverter;
use NcJoes\OfficeConverter\OfficeConverterException;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Writer\HTML;
use setasign\Fpdi\Fpdi;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\Filter\FilterException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use setasign\Fpdi\PdfReader\PdfReaderException;

class BookController extends Controller
{
    public function index()
    {
        return view('books', ['books' => Book::orderBy('id', 'desc')->paginate(6)]);
    }

    /**
     * @throws CrossReferenceException
     * @throws OfficeConverterException
     * @throws PdfReaderException
     * @throws PdfParserException
     * @throws PdfTypeException
     * @throws FilterException
     */
    public function preview($id)
    {
        $book = Book::findOrFail($id);
        $filePath = storage_path('app/public/' . $book->file_path);
        $previewDirectory = storage_path('app/public/previews/');
        $this->ensurePreviewDirectoryExists();
        $previewFilePath = $this->extractFirstPages($filePath);

        $publicPreviewPath = asset('storage/previews/' . basename($previewFilePath));

        return view('books.preview', compact('book', 'publicPreviewPath'));
    }

    /**
     * @throws CrossReferenceException
     * @throws PdfReaderException
     * @throws OfficeConverterException
     * @throws PdfParserException
     * @throws FilterException
     * @throws PdfTypeException
     */
    private function extractFirstPages(string $filePath, int $pageCount = 10): string
    {
        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $outputDirectory = storage_path('app/public/previews/');
        $this->ensurePreviewDirectoryExists();

        $outputFile = $outputDirectory . pathinfo($filePath, PATHINFO_FILENAME) . '_preview.pdf';
        if (in_array($fileExtension, ['doc', 'docx'])) {
            $this->convertWordToPdf($filePath, $outputFile);
        }

        $pdf = new Fpdi();
        if (!file_exists($filePath) || filesize($filePath) === 0) {
            throw new \RuntimeException("FPDI cannot process an empty or missing PDF: $filePath");
        }
        $totalPages = $pdf->setSourceFile($outputFile);
        $pagesToExtract = min($pageCount, $totalPages);

        for ($i = 1; $i <= $pagesToExtract; $i++) {
            $pdf->AddPage();
            $tplIdx = $pdf->importPage($i);
            $pdf->useTemplate($tplIdx);
        }

        $pdf->Output($outputFile, 'F');

        return $outputFile;
    }

    private function ensurePreviewDirectoryExists(): void
    {
        $previewDirectory = storage_path('app/public/previews/');
        if (!file_exists($previewDirectory)) {
              mkdir($previewDirectory, 0755, true);
        }
    }

    /**
     * @throws OfficeConverterException
     */
    private function convertWordToPdf($inputPath, $outputPath): void
    {
        $phpWord = IOFactory::load($inputPath);

        $lang = (new Language())->setLangId(1087); // 1087 = Kazakh language code
        $phpWord->getSettings()->setThemeFontLang($lang);

        $tempHtml = tempnam(sys_get_temp_dir(), 'wordconv') . '.html';
        $htmlWriter = new HTML($phpWord);
        $htmlWriter->save($tempHtml);

        // Inject UTF-8 meta tag at beginning of HTML
        $htmlContent = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . file_get_contents($tempHtml);
        file_put_contents($tempHtml, $htmlContent);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(file_get_contents($tempHtml));
        $dompdf->setPaper('A4');
        $dompdf->render();

        file_put_contents($outputPath, $dompdf->output());
        unlink($tempHtml);
    }


    public function buy($id)
    {
        $book = Book::find($id);
        return Response::make("Buy functionality is not implemented yet for book ID: {$id}", 200);
    }
}
