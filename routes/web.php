<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', BookController::class)->except(['show']);
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::post('/books/{book}/borrow', [LoanController::class, 'borrow'])->name('books.borrow');
    Route::post('/loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');
});
