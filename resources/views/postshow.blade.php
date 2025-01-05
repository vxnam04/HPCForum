@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/postsshow.style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="post-detail">
    <h1>{{ $post->tieuDe }}</h1>
    <p>{{ $post->noiDung }}</p>
</div>
@endsection
