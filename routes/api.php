<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProTextAnalysisController;
use App\Http\Controllers\TextAnalysisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/analyze-text', [TextAnalysisController::class, 'analyzeText']);
Route::post('/words-and-occurrences', [TextAnalysisController::class, 'wordsAndOccurrences']);
Route::post('/check-baskats', [TextAnalysisController::class, 'checkBaskats']);
//Route::post('/upload-file', [FileController::class, 'uploadFile'])->name('upload.file');
Route::post('/import', [FileController::class, 'import']);

Route::post('/pro-analyze-text', [ProTextAnalysisController::class, 'analyzeText']);
Route::post('/pro-words-and-occurrences', [ProTextAnalysisController::class, 'wordsAndOccurrences']);
Route::post('/pro-check-baskats', [ProTextAnalysisController::class, 'checkBaskats']);
