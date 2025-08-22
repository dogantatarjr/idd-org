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

    @auth
        <div class="container my-4">
            <br><br>
            <h2 class="text-center">Hi, {{ Auth::User()->name }}</h2>
        </div>
        <div class="container text-center my-5">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <a class="btn btn-danger btn-lg mx-2" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Çıkış Yap</a>
        </div>
    @endauth

    @guest
        <div class="container text-center my-5">
            <a class="btn btn-success btn-lg mx-2" href="/login">Giriş Yap</a>
            <a class="btn btn-success btn-lg mx-2" href="/register">Kayıt Ol</a>
        </div>
    @endguest

    <br><br><br><br><br>

@endsection
