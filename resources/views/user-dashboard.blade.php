@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/userstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Search.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nutlike.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/binhluan.style.css') }}">
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
                {{-- <li><a href="{{ route('posts.create') }}" class="btn btn-success">Tạo bài viết</a></li> --}}

            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="post-list">
            @forelse ($posts as $post)
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

@section('js')
<script>
    function toggleContent(element) {
        const preview = element.previousElementSibling.previousElementSibling; // .content-preview
        const fullContent = element.previousElementSibling; // .content-full

        if (fullContent.classList.contains('d-none')) {
            preview.classList.add('d-none');
            fullContent.classList.remove('d-none');
            element.innerText = 'Thu gọn'; // Đổi nút thành "thu gọn"
        } else {
            fullContent.classList.add('d-none');
            preview.classList.remove('d-none');
            element.innerText = 'Xem thêm'; // Đổi nút lại thành "xem thêm"
        }
    }
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