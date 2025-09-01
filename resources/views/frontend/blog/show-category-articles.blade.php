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
            <!-- Kategoriye Göre Yazı Listesi -->
            <div class="col-lg-8 mb-4">
            @foreach($articles as $article)
            <div class="col-12 mb-4">
                <h2 class="fw-bold">{{ $categories->where('id', $article->category_id)->first()->name }} Kategorisindeki Yazılar</h2>
            </div>
            <div class="card single_post mb-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="img-post mb-3">
                        <img src="{{ $article->image }}"
                            class="img-fluid rounded" alt="article-image">
                    </div>
                    <h3 class="h5 fw-bold">{{ $article->title }}</h3>
                    <p class="text-muted">
                        {{ Str::limit($article->content, 300) }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/blog/articles/{{ $article->id }}" class="btn btn-outline-success btn-sm rounded-pill px-4">
                            Devamını Oku
                        </a>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item text-uppercase small pe-3 border-end text-secondary">
                                {{ $categories->where('id', $article->category_id)->first()->name }}
                            </li>
                            <li class="list-inline-item"><i class="fa-regular fa-heart text-danger"></i> {{ $article->likes }}</li>
                            <li class="list-inline-item"><i class="fa-regular fa-comment text-primary"></i> {{ $article->comments }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            </div>

            <!-- Yan Panel -->
            @include('frontend.blog.sidebar')
        </div>
    </div>

@endsection
