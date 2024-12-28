<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function checkUserType(){
        if(!Auth::user()){
            return redirect()->route('login');
        }
        if(Auth::user()->userType === 'ADM'){
            return redirect()->route('admin.dashboard');
        }
        if(Auth::user()->userType === 'GV'){
            return redirect()->route('giangvien.dashboard');
        }
        if(Auth::user()->userType === 'USR'){
            return redirect()->route('user.dashboard');
        }
}

}