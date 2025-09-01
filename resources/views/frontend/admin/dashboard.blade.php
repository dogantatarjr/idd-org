@extends('frontend.master')

@section('title', 'Blog')

@section('blog-sit', 'active')

@section('auth-section')

    @auth
        <div class="d-none d-lg-flex align-items-center">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
            </form>
            <a class="btn btn-danger btn-lg mx-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Çıkış Yap</a>
        </div>
    @endauth

    @guest
        <div class="d-none d-lg-flex align-items-center">
            <a class="btn btn-success btn-lg mx-2" href="/login">Giriş Yap</a>
            <a class="btn btn-success btn-lg mx-2" href="/register">Kayıt Ol</a>
        </div>
    @endguest

@endsection

@section('content')

    <div class="blog-page container my-5">
        <div class="row">
            @include('frontend.blog.hello')


        </div>
    </div>

            <section class="py-5 bg-light">
                <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8">
                    <h3 class="mb-4">Admin Paneli</h3>
                    <p class="lead">
                        Bu kısımda admin paneli bulunacaktır.
                    </div>
                </div>
            </section>
            <br><br><br><br><br>

@endsection
