<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verify'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');
});

Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route:: get('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify-email');
