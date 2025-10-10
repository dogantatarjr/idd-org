@extends('frontend.master')

@section('title', 'Blog')

@section('blog-sit', 'active')

@section('content')

    <div class="blog-page container my-5">
        <div class="row">
            @include('frontend.blog.hello')

            @if (session('deactivation'))
                <div class="alert alert-success w-100 text-center">
                    {{ session('deactivation') }}
                </div>
            @endif

            <!-- Blog Listesi -->
            @include('frontend.blog.blog-list')

            <!-- Yan Panel -->
            @include('frontend.blog.sidebar')
        </div>
    </div>

@endsection
