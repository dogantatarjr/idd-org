@extends('frontend.admin.master')

@section('topbar-header', 'Blog Yönetimi')

@section('topbar-icon', 'fas fa-wrench')

@section('blog-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-left">
        <div class="col-auto">

            @include('frontend.admin.blog.latest-articles')

            <br>

            @include('frontend.admin.blog.categories')

            <br><br>

        </div>
    </div>
</div>

@include('frontend.admin.blog.category-detail')

@include('frontend.admin.blog.category-edit')

@include('frontend.admin.blog.category-add')

@endsection
