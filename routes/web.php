<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
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

Route::redirect('', '/mypage');

Route::get('user-login', [AuthController::class, 'loginPage'])->name('user.login.page');
Route::post('user-login', [AuthController::class, 'login'])->name('log.the.user');
Route::get('register', [AuthController::class, 'registrationPage'])->name('user.register.page');
Route::post('register', [AuthController::class, 'register'])->name('register.the.user');
Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::post('/books/buy', [BookController::class, 'buy'])->name('books.buy');
});

Route::get('books', [BookController::class, 'index'])->name('books.all');
Route::get('books/{id}', [BookController::class, 'preview'])->name('books.preview');


Route::get('mypage', [PageController::class, 'index'])->name('main');
Route::get('about', [PageController::class, 'about']);
Route::get('birotanlex', [PageController::class, 'birotanlex']);
Route::get('birotanlex-pro', [PageController::class, 'birotanlexPro'])->name('birotanlex-pro');
Route::get('login', [PageController::class, 'loginPage'])->name('login.page');
Route::post('login', [PageController::class, 'login'])->name('login');
Route::get('technews', [PageController::class, 'technews']);
Route::get('birotanauen', [PageController::class, 'birotanauen'])->name('birotanauen');

