<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'allPosts'])->name('dashboard');


Route::middleware(['auth', 'verify'])->group(function () {
    Route::get('/user-profile', [UserController::class, 'profile'])->name('user-profile');
    Route::get('/edit-profile/{id}', [UserController::class, 'editProfile'])->name('edit-profile');
    Route::put('/update-profile/{id}', [UserController::class, 'updateProfile'])->name('update-profile');
    Route::get('author-profile/{id}', [UserController::class, 'authorProfile'])->name('author-profile');
    Route::get('posts', [PostController::class, 'allPosts'])->name('allPosts');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{id}', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::post('/comment/{id}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/followedPosts', [PostController::class, 'followedPosts'])->name('followedPosts');
});

Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route:: get('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify-email');
Route::get('/resendPage', [AuthController::class, 'resendPage'])->name('resendPage');
Route::post('/resend-verification', [AuthController::class, 'resendVerification'])->name('resend-verification');
