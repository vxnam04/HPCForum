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
                        
                        <button class="statbl" onclick="openCommentModal({{ $post->baiVietID }})">
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
<!-- Modal -->
<div id="commentModal" class="comment-modal">
    <div class="comment-modal-content">
        <span class="close-modal" onclick="closeCommentModal()">&times;</span>
        <div id="modalContent"></div> <!-- Nội dung của bài viết và bình luận sẽ được tải vào đây -->
         <!-- Form bình luận -->
         <div class="comment-form">
            <h3>Thêm bình luận</h3>
            <form id="commentForm" onsubmit="submitComment(event)">
                <textarea name="noiDung" id="commentContent" class="form-control" placeholder="Nhập bình luận của bạn..." required></textarea>
                <button type="submit" class="btn btn-primary mt-2">Gửi bình luận</button>
            </form>
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
function openCommentModal(baiVietID) {
    const modal = document.getElementById('commentModal');
    modal.setAttribute('data-baiVietID', baiVietID);

    fetch(`/posts/${baiVietID}/comments`)
        .then(response => {
            if (!response.ok) {
                // Nếu phản hồi không thành công, ném lỗi
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            let noiDungGioiHan = data.post.noiDung.length > 200 
                ? data.post.noiDung.slice(0, 200) + '...' 
                : data.post.noiDung;

            let modalContent = `
                <h2>${data.post.tieuDe}</h2>
                <p>${noiDungGioiHan}</p>
                <div class="comments-section">
                    <h3>Bình luận</h3>
            `;
            data.comments.forEach(comment => {
                modalContent += `
                    <div class="comment">
                        <p>${comment.noiDung}</p>
                        <p><small>${comment.ngayDang}</small></p>
                    </div>
                `;
            });
            modalContent += `</div>`;
            document.getElementById('modalContent').innerHTML = modalContent;
            modal.style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi tải thông tin.');
        });
}



function closeCommentModal() {
    // Đóng modal
    document.getElementById('commentModal').style.display = 'none';
}
function submitComment(event) {
    event.preventDefault();
    const commentContent = document.getElementById('commentContent').value;
    const modal = document.getElementById('commentModal');
    const baiVietID = modal.getAttribute('data-baiVietID'); // Lấy ID bài viết từ modal

    fetch(`/posts/${baiVietID}/comments`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            noiDung: commentContent,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCommentList(data.comments); // Cập nhật danh sách bình luận
            document.getElementById('commentContent').value = ''; // Xóa nội dung form
        } else {
            alert('Có lỗi xảy ra khi gửi bình luận.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi gửi bình luận.');
    });
}


function updateCommentList(comments) {
    const commentSection = document.querySelector('.comments-section');
    commentSection.innerHTML = ''; // Xóa danh sách bình luận cũ

    comments.forEach(comment => {
        const commentElement = document.createElement('div');
        commentElement.classList.add('comment');
        commentElement.innerHTML = `
            <p>${comment.noiDung}</p>
            <p><small>${comment.ngayDang}</small></p>
        `;
        commentSection.appendChild(commentElement);
    });
}



</script>

@endsection
