@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/userstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Search.style.css') }}">
@endsection


@section('content')
<div class="blog-container my-5">
    <header class="blog-header">
        <h1 class="blog-title">BLOGGER</h1>
        <nav class="blog-nav">
            <ul class="blog-menu">
                <li>
                    <form action="{{ route('posts.search') }}" method="GET" class="d-flex">
                        <input type="text" name="query" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
                    </form>
                    
                </li>
            </ul>
        </nav>
    </header>

    <div class="header1">
        @if(request('query'))
            <p>Kết quả tìm kiếm cho: <strong>{{ request('query') }}</strong></p>
        @endif
    </div>
    
    <div class="content">
        @if($posts->isEmpty())
            <p>Không tìm thấy bài viết nào phù hợp.</p>
        @else
            <ul>
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
            </ul>
        @endif
    </div>
    
    
</div>
@endsection
