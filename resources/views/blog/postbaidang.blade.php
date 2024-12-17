@extends('layouts.app')

@section('contentbaidang')
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Danh sách bài viết</h1>
        </div>
        
        <div class="post-list">
            @forelse ($postbaidang as $post)
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
            @empty
                <p class="post-footer">Không có bài viết nào.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
@endsection
