<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\Exception\Exception;
use setasign\Fpdi\Fpdi;
use PhpOffice\PhpWord\IOFactory;
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

    public function preview($id)
    {
        $book = Book::findOrFail($id);
        $filePath = storage_path('app/public/' . $book->file_path);

        $previewFilePath = $this->extractFirstPages($filePath, 10);
        $publicPreviewPath = asset('storage/previews/' . basename($previewFilePath));

        return view('books.preview', compact('book', 'publicPreviewPath'));
    }

    /**
     * @throws CrossReferenceException
     * @throws PdfReaderException
     * @throws PdfParserException
     * @throws PdfTypeException
     * @throws FilterException
     */
    private function extractFirst10PagesFromPDF(string $filePath): ?string
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new InvalidArgumentException("The file does not exist or is not readable: {$filePath}");
        }

        $outputDirectory = __DIR__ . '/previews/';
        if (!is_dir($outputDirectory) && !mkdir($outputDirectory, 0755, true) && !is_dir($outputDirectory)) {
            throw new RuntimeException("Failed to create output directory: {$outputDirectory}");
        }

        $outputFile = $outputDirectory . pathinfo($filePath, PATHINFO_FILENAME) . "_preview.pdf";

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($filePath);
        $pagesToExtract = min(10, $pageCount);

        for ($i = 1; $i <= $pagesToExtract; $i++) {
            $pdf->AddPage();
            $tplIdx = $pdf->importPage($i);
            $pdf->useTemplate($tplIdx);
        }

        $pdf->Output($outputFile, 'F');

        return $outputFile;
    }

    /**
     * @throws Exception
     */
    private function extractFirst10PagesFromWord(string $filePath): ?string
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new InvalidArgumentException("The file does not exist or is not readable: {$filePath}");
        }

        $outputDirectory = __DIR__ . '/previews/';
        if (!is_dir($outputDirectory) && !mkdir($outputDirectory, 0755, true) && !is_dir($outputDirectory)) {
            throw new RuntimeException("Failed to create output directory: {$outputDirectory}");
        }

        $pdfFile = $outputDirectory . pathinfo($filePath, PATHINFO_FILENAME) . ".pdf";

        $phpWord = IOFactory::load($filePath);
        $pdfWriter = IOFactory::createWriter($phpWord);
        $pdfWriter->save($pdfFile);

        return $this->extractFirst10PagesFromPDF($pdfFile);
    }


    public function extractFirstPages(string $filePath, int $pageCount): ?string
    {
        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        switch ($fileExtension) {
            case 'pdf':
                return $this->extractFirst10PagesFromPDF($filePath);
            case 'doc':
            case 'docx':
                return $this->extractFirst10PagesFromWord($filePath);
            default:
                throw new InvalidArgumentException("Unsupported file type: {$fileExtension}");
        }
    }


    public function buy($id)
    {
        $book = Book::find($id);
        return Response::make("Buy functionality is not implemented yet for book ID: {$id}", 200);
    }
}
