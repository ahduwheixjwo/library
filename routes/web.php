<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;

Route::get('/', function() { return redirect(route('login'));});

Route::middleware(['auth'])->group(function() {
    Route::resource('books', BookController::class)->only('index');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::resource('books', BookController::class)->except('index');
    Route::put('/books/borrow', [BookController::class, 'borrow'])->name('books.borrow');
});

// Auth

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');