@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/createbaiviet.style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="container1 my-5">
    <h2 class="text-center">Chỉnh sửa bài viết</h2>
    <form action="{{ route('post.update', $post->baiVietID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="tieuDe" class="form-label">Tiêu đề</label>
            <input type="text" id="tieuDe" name="tieuDe" class="form-control" value="{{ $post->tieuDe }}" required>
        </div>
        <div class="mb-3">
            <label for="noiDung" class="form-label">Nội dung</label>
            <textarea id="noiDung" name="noiDung" class="form-control" rows="10" required>{{ $post->noiDung }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>
@endsection
