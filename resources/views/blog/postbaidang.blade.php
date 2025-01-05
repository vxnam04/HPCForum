@extends('layouts.app')

@section('contentbaidang')
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userstyle.css') }}">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarItems = document.querySelectorAll('.sidebar ul li');

            sidebarItems.forEach(item => {
                item.addEventListener('click', function () {
                    this.classList.toggle('open');
                });
            });
        });
    </script>
</head>
<body>
    <div class="box-all-baidang">
    <div class="sidebar">
        <h2 class="sizechu">Danh mục</h2>
        <ul>
            <li>
                <p class="mauchu">Khoa-Phòng</p>
                <ul>
                    <li>Hệ thống Thông tin</li>
                    <li>Khoa Ngôn ngữ và Văn hóa Hàn Quốc</li>
                    <li>Khoa Ngôn ngữ và Văn hóa Trung Quốc</li>
                    <li>Khoa Ngôn ngữ và Văn hóa Nhật Bản</li>
                    <li>Khoa Ngôn ngữ Anh</li>
                    <li>Khoa Kinh Tế</li>
                    <li>Khoa Công nghệ – Thông tin</li>
                    <li>Khoa Điện</li>
                    <li>Khoa Công nghệ Ô tô</li>
                    <li>Khoa Chăm sóc sắc đẹp</li>
                    <li>Khoa Du lịch – Khách sạn</li>
                </ul>
                
            </li>
            
            <li>
                
                <p class="mauchu">Câu lạc bộ</p>
                <ul>
                    <li>CLB Văn nghệ</li>
                    <li>CLB Thể thao</li>
                    <li>CLB Tiếng Anh</li>
                    <li>CLB Tình nguyện</li>
                    <li>CLB Kỹ năng sống</li>
                </ul>
                
            </li>
            <li>Khác</li>
        </ul>
    </div>

    <div class="container">
        <div class="post-list">
            @forelse ($postbaidang as $post)
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
            @empty
                <p class="post-footer">Không có bài viết nào.</p>
            @endforelse
        </div>
    </div>
</div>
</body>
</html>
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