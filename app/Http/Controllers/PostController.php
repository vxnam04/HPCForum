<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\BinhLuan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index() {
    
    $postbaidang = Post::all();  // Hoặc câu truy vấn phù hợp để lấy dữ liệu
        
    return view('blog\postbaidang', compact('postbaidang'));
    }
   public function search(Request $request)
{
    $query = $request->input('query');
    $posts = Post::where('tieuDe', 'like', "%{$query}%")->get();

    return view('Search', compact('posts', 'query'));
}
    // Hiển thị form tạo bài viết
    public function create()
    {
        return view('posts.create');
    }

    // Lưu bài viết mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Kiểm tra nếu người dùng không phải giảng viên
        if (auth()->user()->userType != 'GV') {
            return redirect()->route('baidang')->with('error', 'Chỉ giảng viên mới có thể tạo bài viết!');
        }
    
        $validated = $request->validate([
            'tieuDe' => 'required|max:255',
            'noiDung' => 'required',
        ]);
    
        $post = new Post();
        $post->tieuDe = $validated['tieuDe'];
        $post->noiDung = $validated['noiDung'];
        $post->ngayDang = now();
        $post->soLike = 0;
        $post->soBinhLuan = 0;
        $post->trangThaiDuyet = 0; // Chưa duyệt
        $post->userID = auth()->id();
        $post->save();
    
        return redirect()->route('baidang')->with('success', 'Bài viết đã được tạo thành công!');
    }
    
}

