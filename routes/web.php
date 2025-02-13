<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth', 'verify'])->group(function () {

});

Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route:: get('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify-email');
Route::get('/resendPage', [AuthController::class, 'resendPage'])->name('resendPage');
Route::post('/resend-verification', [AuthController::class, 'resendVerification'])->name('resend-verification');
