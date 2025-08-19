@extends('frontend.master')

@section('title', 'Blog')

@section('blog-sit', 'active')

@section('content')

    <br><br><br><br><br>

    <section class="py-5 bg-light">
        <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
            <h3 class="mb-4">Blog</h3>
            <p class="lead">
                Bu kısımda organizasyonun blog yazıları ve haberleri paylaşılacaktır.
            </p>
            </div>
        </div>
    </section>

    <div class="container text-center my-5">
        <a class="btn btn-success btn-lg mx-2" href="/login">Giriş Yap</a>
        <a class="btn btn-success btn-lg mx-2" href="/register">Kayıt Ol</a>
        <br><br>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a class="btn btn-danger btn-lg mx-2">Çıkış Yap</a>
        </form>
    </div>

    <br><br><br><br><br>

@endsection
