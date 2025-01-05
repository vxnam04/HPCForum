@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/userstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Search.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nutlike.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/binhluan.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/createbaiviet.style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="blog-container my-5">
    <header class="blog-header">
        <nav class="blog-nav">
            <ul class="blog-menu">
                <li><a href="/baidang" class="blog-link">Bài đăng</a></li>
                
                <li><a href="#" class="blog-link">Thông báo</a></li>
                <li>
                    <form action="{{ route('posts.search') }}" method="GET" class="d-flex">
                        <input type="text" name="query" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
                    </form>
                    
                </li>
                @if(Auth::check() && Auth::user()->userType === 'GV') <!-- Kiểm tra ID type -->
                <li><a href="{{ route('posts.create') }}" class="taobaiviet">Tạo bài viết</a></li>
            @endif
            </ul>
        </nav>
    </header>

    <div class="container">

        
        <div class="post-list">
            @forelse ($posts as $post)
                <div class="post-item1">
                    <div class="post-item">
                        <div class="post-title">{{ $post->tieuDe }}</div>
                        <div class="post-content">{{ $post->noiDung }}</div>
                        <div class="post-stats">
                            <button class="like-button" onclick="handleLike()">
                                <i class="fa fa-thumbs-up"></i> Thích<span class="like-count">{{ $post->soLike }}</span>
                            </button>
                            <button class="statbl" onclick="handleComment()">
                                <i class="fa fa-comment"></i> Bình luận<span class="comment-count">{{ $post->soBinhLuan }}</span>
                            </button>
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
