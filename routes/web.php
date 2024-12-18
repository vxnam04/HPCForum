<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class,'checkUserType','homepage'])->name('home');


Route::get('/admin/dashboard', function () {
    return view('admin-dashboard');
})->name('admin.dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/user/dashboard', function () {
    return view('user-dashboard');
})->name('user.dashboard');


// Route dành cho trang user dashboard
Route::middleware('auth')->get('/user-dashboard', [UserController::class, 'index'])->name('user.dashboard');
use App\Http\Controllers\BlogController;

use App\Http\Controllers\PostController;

Route::resource('/baidang', PostController::class);


Route::get('/', [BlogController::class, 'index'])->name('home');



Route::get('/posts', [PostController::class, 'search'])->name('posts.search');
Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');
Route::post('/posts/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');


