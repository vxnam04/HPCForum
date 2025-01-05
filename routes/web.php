<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GiangvienController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
// Trang chủ
Route::get('/', [HomeController::class, 'checkUserType'])->name('home');

// Route dành cho admin
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/admin/dashboard', 'admin-dashboard')->name('admin.dashboard');
    Route::get('/admin-dashboard', [PostController::class, 'index1'])->name('admin.dashboard');
    Route::delete('/posts/{baiVietID}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/searchadmin', [PostController::class, 'searchadmin'])->name('posts.searchadmin');
    Route::get('/users', [UserController::class, 'index2'])->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/roles', [UserController::class, 'editRoles'])->name('users.editRoles');
    Route::put('/users/{id}/roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');

});


// Route dành cho sinh vien
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user-dashboard', [UserController::class, 'index1'])->name('user.dashboard');
});
// Route dành cho giang vien
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    

    Route::get('/giangvien/dashboard', [GiangvienController::class, 'index1'])->name('giangvien.dashboard');
});
    // Route::get('/giangvien/dashboard', [GiangvienController::class, 'dashboard'])->name('giangvien.dashboard');
    
// Route dành cho blog và bài viết
Route::prefix('baidang')->group(function () {
    Route::resource('/', PostController::class);
    Route::get('/search', [PostController::class, 'search'])->name('posts.search');
    Route::post('/{id}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');
});
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/baidang', [PostController::class, 'index'])->name('baidang');
