<?php

namespace App\Http\Controllers;

use App\Imports\BaskatsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Smalot\PdfParser\Parser;
use Smalot\PdfParser\Parser as PdfParser;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use Spatie\PdfToText\Pdf;

class FileController extends Controller
{
    /**
     * @throws \Exception
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:txt,pdf,doc,docx'
        ]);

        $file = $request->file('file');
        $text = '';

        switch ($file->getClientOriginalExtension()) {
            case 'txt':
                $text = file_get_contents($file->getRealPath());
                break;
            case 'pdf':
                try {
                    // Use Spatie's Pdf class to extract the text
                    //$fileName = $file->getClientOriginalName();

                    $pdfParser = new Parser();
                    $pdf = $pdfParser->parseFile($file->path());
                    $text = $pdf->getText();
                } catch (\Exception $e) {
                    // Handle the exception if something goes wrong
                    logger('PDF Parse Error: ' . $e->getMessage());
                    $text = "Error parsing PDF: " . $e->getMessage();
                }
                break;
            case 'doc':
            case 'docx':
                $phpWord = WordIOFactory::load($file->getRealPath());
                $text = strip_tags($phpWord->getSections()[0]->getElements()[0]->getText()); // Simple extraction
                break;
        }

        return response()->json(['text' => $text]);
    }


}

