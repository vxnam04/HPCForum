<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            return $next($request);
        }

        // Chuyển hướng nếu không đăng nhập
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập!');
    }
}
