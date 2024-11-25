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

    private function extractFirstPages(string $filePath, int $pageCount)
    {
        $outputDirectory = storage_path('app/public/previews/');
        if (!file_exists($outputDirectory)) {
            mkdir($outputDirectory, 0755, true);
        }

        $outputFile = $outputDirectory . pathinfo($filePath, PATHINFO_FILENAME) . "_preview.pdf";

        $command = "gs -sDEVICE=pdfwrite -dNOPAUSE -dQUIET -dBATCH -dFirstPage=1 -dLastPage={$pageCount} -sOutputFile={$outputFile} {$filePath}";
        exec($command);

        return $outputFile;
    }

    public function buy($id)
    {
        $book = Book::find($id);
        return Response::make("Buy functionality is not implemented yet for book ID: {$id}", 200);
    }
}
