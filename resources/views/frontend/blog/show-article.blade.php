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
<div class="container">
    <h1>{{ $article->title }}</h1>
    <p class="text-muted">
        Yazar: {{ $article->user->name }} |
        Tarih: {{ $article->created_at->format('d.m.Y') }}
    </p>
    <div class="mt-4">
        {!! nl2br(e($article->content)) !!}
    </div>
</div>
@endsection
