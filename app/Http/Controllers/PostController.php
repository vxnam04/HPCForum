<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index() {
    
    $postbaidang = Post::all();  // Hoặc câu truy vấn phù hợp để lấy dữ liệu
        
    return view('blog\postbaidang', compact('postbaidang'));
    }
    
    // Hiển thị form tạo bài viết mới
    // public function create()
    // {
    //     return view('posts.create');
    // }

    // Lưu bài viết mới vào database
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'baiVietID' => 'required|unique:posts|max:50',
    //         'tieuDe' => 'required|max:255',
    //         'noiDung' => 'required',
    //         'ngayDang' => 'date',
    //         'soLike' => 'integer',
    //         'soBinhLuan' => 'integer',
    //         'trangThaiDuyet' => 'boolean',
    //         'userID' => 'required|max:50',
    //     ]);

    //     Post::create($validatedData);
    //     return redirect()->route('posts.index')->with('success', 'Bài viết đã được tạo thành công!');
    // }

    // Hiển thị chi tiết bài viết
    // public function show(Post $post)
    // {
    //     return view('postbaidang.show', compact('post'));
    // }

    // Hiển thị form chỉnh sửa bài viết
    // public function edit(Post $post)
    // {
    //     return view('postbaidang.edit', compact('post'));
    // }

    // // Cập nhật bài viết
    // public function update(Request $request, Post $post)
    // {
    //     $validatedData = $request->validate([
    //         'tieuDe' => 'required|max:255',
    //         'noiDung' => 'required',
    //         'ngayDang' => 'date',
    //         'soLike' => 'integer',
    //         'soBinhLuan' => 'integer',
    //         'trangThaiDuyet' => 'boolean',
    //         'userID' => 'required|max:50',
    //     ]);

    //     $post->update($validatedData);
    //     return redirect()->route('posts.index')->with('success', 'Bài viết đã được cập nhật thành công!');
    // }

    // Xóa bài viết
    // public function destroy(Post $post)
    // {
    //     $post->delete();
    //     return redirect()->route('posts.index')->with('success', 'Bài viết đã được xóa thành công!');
    // }
}
