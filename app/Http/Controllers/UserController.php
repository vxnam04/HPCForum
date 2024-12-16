<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        $user = Auth::user();

        // Truyền thông tin user vào view
        return view('user-dashboard', compact('user'));
    }
}
