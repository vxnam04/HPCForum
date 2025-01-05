{{-- @extends('user-dashboard') --}}

@section('baivietmoinhat')
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nutlike.style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
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
                        <a href="{{ route('posts.show', ['baiVietID' => $post->baiVietID]) }}" class="post-title-link">
                            <div class="post-title">{{ $post->tieuDe }}</div>
                        </a>
                        <div class="post-content">
                            <span class="content-preview">{{ \Illuminate\Support\Str::limit($post->noiDung, 250, '...') }}</span>
                            <span class="content-full d-none">{{ $post->noiDung }}</span>
                            @if(strlen($post->noiDung) > 200)
                                <span class="xemthem" onclick="toggleContent(this)">xem thêm</span>
                            @endif
                        </div>
                        
                        <div class="post-stats">
                            <button class="like-button" onclick="handleLike({{ $post->baiVietID }}, this)">
                                <i class="fa fa-thumbs-up"></i> Thích<span class="like-count">{{ $post->soLike }}</span>
                            </button>
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

@section('js')
<script>
    function handleLike(baiVietID, button) {
    fetch(`/posts/${baiVietID}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const likeCount = button.querySelector('.like-count');
            likeCount.innerText = data.newLikeCount;
        } else {
            alert('Có lỗi xảy ra. Vui lòng thử lại.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại.');
    });
}
</script>

@endsection