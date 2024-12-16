<?php

namespace App\Http\Controllers;

use App\Models\Post; // Đảm bảo đã import model Post
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Phương thức hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::all(); // Lấy tất cả bài viết từ bảng 'posts'
        return view('blog\blogindex', compact('posts')); // Truyền dữ liệu vào view 'blog.index'
    }
}
