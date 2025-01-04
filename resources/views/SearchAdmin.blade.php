@extends('layouts.admin')

@section('head1')
<link rel="stylesheet" href="{{ asset('css/admin/baidang.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/navbar.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/search.style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@endsection

@section('content1')
<div class="blog-container my-5">
    <header class="blog-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">Home </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link item-active" href="#">Bài Đăng<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tài Khoản</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link item-disabled" href="#">Disabled</a>
                    </li>
                </ul>
                        <form action="{{ route('posts.search') }}" method="GET" class="d-flex">
                            <input type="text" name="query" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="{{ request('query') }}">
                            <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
                        </form>
            </div>
        </nav>
    </header>

    <div class="container">    
        <div class="post-list">
            @forelse ($posts as $post)
                <div class="post-item1">
                    <div class="post-item">
                        <div class="post-title">
                            <p>Tiêu đề</p>
                            {{ $post->tieuDe }}
                        </div>
                        <div class="post-content">
                            <p>Nội dung</p>
                            {{ $post->noiDung }}
                        </div>
                        <div class="post-stats">
                            <p>Số Like</p>
                            <span class="like-button" onclick="handleLike()">
                                <i class="fa fa-thumbs-up"></i> Thích<span class="like-count chung">{{ $post->soLike }}</span>
                            </span>
                        </div>
                        <div class="post-stats">
                            <p>Số bình luận</p>
                            <span class="statbl" onclick="handleComment()">
                                <i class="fa fa-comment"></i> Bình luận<span class="comment-count chung">{{ $post->soBinhLuan }}</span>
                            </span>
                        </div>
                        <div class="stat1">
                            <p>Ngày đăng</p>
                            @if($post->ngayDang)
                                {{ \Carbon\Carbon::parse($post->ngayDang)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="post-stats">
                            <p>Xóa bài viết</p>
                            <button class="delete-button" onclick="handleDelete({{ $post->baiVietID}})">
                                <i class="fa fa-trash"></i> Xóa bài viết
                            </button>
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
    function handleDelete(postId) {
    if (confirm("Bạn có chắc chắn muốn xóa bài viết này?")) {
        // Gửi yêu cầu xóa bài viết đến server bằng phương thức DELETE
        fetch(`/posts/${postId}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => {
            if (response.ok) {
                alert("Xóa bài viết thành công!");
                // Tải lại trang hoặc cập nhật giao diện
                location.reload(); 
            } else {
                alert("Đã xảy ra lỗi khi xóa bài viết.");
            }
        })
        .catch(error => {
            console.error("Lỗi:", error);
            alert("Không thể kết nối tới server.");
        });
    }
}

</script>
@endsection