@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/userstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
@endsection

@section('content')
<div class="blog-container my-5">
    <header class="blog-header">
        <h1 class="blog-title">BLOGGER</h1>
        <nav class="blog-nav">
            <ul class="blog-menu">
                <li><a href="/baidang" class="blog-link">Bài đăng</a></li>
                <li><a href="/search" class="blog-link">Tìm kiếm</a></li>
                <li><a href="/posts" class="blog-link">Thông báo</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="header">
            <h1>Danh sách bài viết</h1>
        </div>
        
        <div class="post-list">
            @forelse ($posts as $post)
                <div class="post-item">
                    <div class="post-item">
                        <div class="post-title">{{ $post->tieuDe }}</div>
                        <div class="post-content">{{ $post->noiDung }}</div>
                        <div class="post-stats">
                            <div class="stat">Số lượt thích: {{ $post->soLike }}</div>
                            <div class="stat">Số bình luận: {{ $post->soBinhLuan }}</div>
                        </div>
                        <div class="stat1">Ngày đăng: 
                            @if($post->ngayDang)
                                {{ \Carbon\Carbon::parse($post->ngayDang)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="post-footer">Không có bài viết nào.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection