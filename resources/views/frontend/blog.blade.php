@extends('frontend.master')

@section('title', 'Blog')

@section('blog-sit', 'active')

@section('content')

    <div class="blog-page container my-5">
        <div class="row">
            @include('frontend.blog.hello')

            <!-- Blog Listesi -->
            @include('frontend.blog.blog-list')

            <!-- Yan Panel -->
            @include('frontend.blog.sidebar')
        </div>
    </div>

@endsection
