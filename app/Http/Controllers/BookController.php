<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use Smalot\PdfParser\Parser;

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

    private function extractFirstPagesFromPDF(string $filePath, int $pageCount): ?string
    {
        // Validate input parameters
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new InvalidArgumentException("The file does not exist or is not readable: {$filePath}");
        }

        if ($pageCount <= 0) {
            throw new InvalidArgumentException("Page count must be a positive integer.");
        }

        // Define the output directory and ensure it exists
        $outputDirectory = storage_path('app/public/previews/');
        if (!is_dir($outputDirectory) && !mkdir($outputDirectory, 0755, true) && !is_dir($outputDirectory)) {
            throw new RuntimeException("Failed to create output directory: {$outputDirectory}");
        }

        // Define the output file path
        $outputFile = $outputDirectory . pathinfo($filePath, PATHINFO_FILENAME) . "_preview.pdf";

        // Check if Ghostscript is installed
        $ghostscriptPath = 'gs'; // Assuming 'gs' is in the system's PATH
        $ghostscriptCheck = shell_exec("command -v {$ghostscriptPath}");
        if (empty($ghostscriptCheck)) {
            throw new RuntimeException("Ghostscript is not installed or not found in the system's PATH.");
        }

        // Construct the Ghostscript command
        $escapedInputFile = escapeshellarg($filePath);
        $escapedOutputFile = escapeshellarg($outputFile);
        $command = "{$ghostscriptPath} -sDEVICE=pdfwrite -dNOPAUSE -dQUIET -dBATCH -dFirstPage=1 -dLastPage={$pageCount} -sOutputFile={$escapedOutputFile} {$escapedInputFile}";

        // Execute the command and capture output and return status
        exec($command, $output, $returnVar);

        // Check for errors during execution
        if ($returnVar !== 0) {
            $outputText = implode("\n", $output);
            throw new RuntimeException("Ghostscript command failed with status {$returnVar}: {$outputText}");
        }

        // Verify that the output file was created
        if (!file_exists($outputFile)) {
            throw new RuntimeException("Failed to create the output PDF: {$outputFile}");
        }

        return $outputFile;
    }

    private function convertWordToPDF(string $filePath): ?string
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new InvalidArgumentException("The file does not exist or is not readable: {$filePath}");
        }

        $outputDirectory = storage_path('app/public/previews/');
        if (!is_dir($outputDirectory) && !mkdir($outputDirectory, 0755, true) && !is_dir($outputDirectory)) {
            throw new RuntimeException("Failed to create output directory: {$outputDirectory}");
        }

        $outputFile = $outputDirectory . pathinfo($filePath, PATHINFO_FILENAME) . ".pdf";

        $libreOfficePath = 'soffice'; // Assuming 'soffice' is in the system's PATH
        $libreOfficeCheck = shell_exec("command -v {$libreOfficePath}");
        if (empty($libreOfficeCheck)) {
            throw new RuntimeException("LibreOffice is not installed or not found in the system's PATH.");
        }

        $escapedInputFile = escapeshellarg($filePath);
        $escapedOutputDir = escapeshellarg($outputDirectory);
        $command = "{$libreOfficePath} --headless --convert-to pdf {$escapedInputFile} --outdir {$escapedOutputDir}";

        exec($command, $output, $returnVar);

        if ($returnVar !== 0 || !file_exists($outputFile)) {
            throw new RuntimeException("Failed to convert Word document to PDF.");
        }

        return $outputFile;
    }

    private function extractFirstPagesFromWord(string $filePath, int $pageCount): ?string
    {
        $pdfFile = $this->convertWordToPDF($filePath);
        return $this->extractFirstPagesFromPDF($pdfFile, $pageCount);
    }


    public function extractFirstPages(string $filePath, int $pageCount): ?string
    {
        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        return match ($fileExtension) {
            'pdf' => $this->extractFirstPagesFromPDF($filePath, $pageCount),
            'doc', 'docx' => $this->extractFirstPagesFromWord($filePath, $pageCount),
            default => throw new InvalidArgumentException("Unsupported file type: {$fileExtension}"),
        };
    }


    public function buy($id)
    {
        $book = Book::find($id);
        return Response::make("Buy functionality is not implemented yet for book ID: {$id}", 200);
    }
}
