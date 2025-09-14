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
            <div class="col-lg-8 mb-4">
                <div class="card single_post shadow-sm border-0">
                    <img src="{{ $article->image }}" class="card-img-top rounded" alt="article-image">
                    <br>
                    <div class="card-body">
                        <h1 class="h3 fw-bold mb-3">{{ $article->title }}</h1>
                        <div class="text-muted small mb-4">
                            <i class="fa fa-user me-2"></i> {{ $article->user->name }}
                            <span class="mx-2">|</span>
                            <i class="fa fa-calendar me-2"></i> {{ $article->created_at->format('d.m.Y') }}
                            <span class="mx-2">|</span>
                            <i class="fa fa-folder-open me-2"></i> {{ $article->category->name }}
                        </div>

                        {!! nl2br(e($article->content)) !!}

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <i class="fa-regular fa-heart text-danger me-2"></i> {{ $article->likes }}
                                <i class="fa-regular fa-comment text-primary ms-4 me-2"></i> {{ $article->comments }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yorumlar -->
                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Yorumlar</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Ahmet</strong>
                            <p class="mb-1">Gerçekten güzel bir yazı olmuş!</p>
                            <small class="text-muted">2 saat önce</small>
                        </div>
                        <hr>
                        <form>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="Yorumunuzu yazın..."></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-success">Gönder</button>
                                <a href="{{ route('blog') }}" class="btn btn-outline-success">
                                    <i class="fa fa-arrow-left me-2"></i> Blog Anasayfasına Dön
                                </a>
                            </div>
                        </form>
                    </div>
                </div>


            </div>

            @include('frontend.blog.sidebar')

        </div>
    </div>

@endsection
