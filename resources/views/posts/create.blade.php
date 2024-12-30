@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/createbaiviet.style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="container1 my-5">
    <h2 class="text-center">Tạo bài viết mới</h2>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tieuDe" class="form-label">Tiêu đề bài viết</label>
            <input type="text" name="tieuDe" id="tieuDe" class="form-control" placeholder="Nhập tiêu đề bài viết" required>
        </div>
        <div class="mb-3">
            <label for="noiDung" class="form-label">Nội dung bài viết</label>
            <textarea name="noiDung" id="noiDung" rows="6" class="form-control" placeholder="Nhập nội dung bài viết" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Đăng bài viết</button>
    </form>
</div>
@endsection
