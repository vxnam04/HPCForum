@extends('layouts.app')

@section('content')
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
     <!-- If additional specific styles are needed per page -->
</head>
<body>
    <div class="sidebar">
        <h2>Thể Loại</h2>
        <ul>
            <li><a href="#">Kinh Doanh</a></li>
            <li><a href="#">Bóng Đá</a></li>
            <li><a href="#">Giáo Dục</a></li>
            <li><a href="#">Thời Sự</a></li>
        </ul>
    </div>
    <div class="main-content">
        @foreach($posts as $post)
            <article>
                <h2>{{ $post->title }}</h2>
                <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
                <p>{{ $post->excerpt }}</p>
            </article>
        @endforeach
    </div>
</body>
</html>
@endsection
