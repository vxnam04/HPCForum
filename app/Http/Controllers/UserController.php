<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
class UserController extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        $user = Auth::user();

        // Truyền thông tin user vào view
        return view('user-dashboard', compact('user'));
    }
    public function index1() {
        // Truy vấn danh sách bài viết
        $posts = Post::orderBy('ngayDang', 'desc')->take(5)->get();
        return view('user-dashboard', compact('posts'));
    }
 
}
