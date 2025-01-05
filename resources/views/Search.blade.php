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
</script>

@endsection