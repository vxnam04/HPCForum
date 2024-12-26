{{-- @extends('user-dashboard') --}}

@section('baivietmoinhat')
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.style.css') }}">
     <!-- If additional specific styles are needed per page -->
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Danh sách bài viết</h1>
        </div>
        
        <div class="post-list">
            @forelse ($latestPosts as $post)
                <div class="post-item1">
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
</body>
</html>
@endsection
