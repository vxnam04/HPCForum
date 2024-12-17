<?php

namespace App\Http\Controllers;

use App\Models\Post; // Giả sử bạn có model Post
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
{
    // Lấy 5 bài viết mới nhất, sắp xếp theo cột 'ngay_dang'
    $posts = Post::orderBy('ngayDang', 'desc')->take(5)->get();

    return view('user-dashboard', compact('posts'));
}

}
