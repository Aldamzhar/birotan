<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/mypage');


Route::get('/mypage', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/birotanlex', [PageController::class, 'birotanlex']);
Route::get('/birotanlex-pro', [PageController::class, 'birotanlexPro'])->name('birotanlex-pro');
Route::get('/login', [PageController::class, 'loginPage'])->name('login.page');
Route::post('/login', [PageController::class, 'login'])->name('login');
Route::get('/technews', [PageController::class, 'technews']);
Route::get('/birotanauen', [PageController::class, 'birotanauen'])->name('birotanauen');

