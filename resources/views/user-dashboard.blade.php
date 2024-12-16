@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/userstyle.css') }}">
    @section('baidang')
    <link rel="stylesheet" href="{{ asset('css/blog.style.css') }}">
@endsection

@section('content')
<div class="container my-5">
    <header>
        <h1>BLOGGER</h1>
        <nav>
            <ul>
                <li><a href="/baidang">Bài đăng</a></li>
                <li><a href="/search">Tìm kiếm</a></li>
                <li><a href="/posts">Bài đăng</a></li>
            </ul>
        </nav>
    </header>
</div>
@endsection
