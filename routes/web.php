<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;

// Trang chủ
Route::get('/', [HomeController::class, 'checkUserType'])->name('home');

// Route dành cho admin
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/admin/dashboard', 'admin-dashboard')->name('admin.dashboard');
});

// Route dành cho user
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user-dashboard', [UserController::class, 'index1'])->name('user.dashboard');
});

// Route dành cho blog và bài viết
Route::prefix('baidang')->group(function () {
    Route::resource('/', PostController::class);
    Route::get('/search', [PostController::class, 'search'])->name('posts.search');
    Route::post('/{id}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');
});

