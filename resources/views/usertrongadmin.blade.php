@extends('layouts.admin')

@section('head1')
<link rel="stylesheet" href="{{ asset('css/admin/nguoidung.style.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/navbar.style.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/search.style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@endsection

@section('content2')
<div class="blog-container my-5">
    <header class="blog-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link item-active" href="/">Bài Đăng<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Tài Khoản</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link item-disabled" href="#">Disabled</a>
                    </li>
                </ul>
                <form action="{{ route('posts.searchadmin') }}" method="GET" class="d-flex">
                    <input type="text" name="query" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
                </form>
            </div>
        </nav>
    </header>

    <div class="container my-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày Tạo</th>
                    <th class="hd">Hành Động</th>
                    <th class="hd">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm hd" onclick="handleDeleteUser({{ $user->id }})">  <i class="fa fa-trash"> </i>Xóa tài khoản</button>
                            
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm hd" onclick="handleAssignRole({{ $user->id }})">Phân Quyền</button>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Không có người dùng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    function handleDeleteUser(id) {
        if (confirm("Bạn có chắc chắn muốn xóa tài khoản này?")) {
            fetch(`/users/${id}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => {
                if (response.ok) {
                    alert("Xóa tài khoản thành công!");
                    location.reload(); // Tải lại trang để cập nhật danh sách
                } else {
                    alert("Đã xảy ra lỗi khi xóa tài khoản.");
                }
            })
            .catch(error => {
                console.error("Lỗi:", error);
                alert("Không thể kết nối tới server.");
            });
        }
    }
    function handleAssignRole(id) {
    // Chuyển hướng đến trang phân quyền với route phù hợp
    window.location.href = `/users/{id}/roles`;
}

</script>
@endsection
