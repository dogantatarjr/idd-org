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
            <div class="col-12 mb-4">
                <h2 class="fw-bold">{{ $category->name }} Konulu Yazılar</h2>
            </div>
            @foreach($articles as $article)
            <div class="card single_post mb-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="img-post mb-3">
                        <img src="{{ $article->image }}"
                            class="img-fluid rounded object-fit-cover"
                            style="height: 300px; width: 100%;"
                            alt="article-image">
                    </div>
                    <h3 class="h5 fw-bold">{{ $article->title }}</h3>
                    @php
                        $maxWords = 50;

                        // <p> tag'i hariç tüm HTML tag'lerini ve içindekileri kaldır
                        $text = preg_replace_callback('/<([^p][^>]*)>.*?<\/\1>/', function($matches) {
                            return ''; // <p> hariç tüm tag'ler ve içi silinir
                        }, $article->content);

                        $temp = strip_tags($text);

                        // Kelime sayısına göre kısalt
                        $words = Str::words($temp, $maxWords, '...');

                        $lastPeriodPos = strrpos($words, '.');

                        if ($lastPeriodPos !== false) {
                            $words = substr($words, 0, $lastPeriodPos + 1);
                        } else {
                            $words .= '...';
                        }
                    @endphp
                    <p class="text-muted">
                        {{ $words }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/blog/articles/{{ $article->id }}" class="btn btn-outline-success btn-sm rounded-pill px-4">
                            Devamını Oku
                        </a>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item text-uppercase small pe-3 border-end text-secondary">
                                {{ $article->category->name }}
                            </li>
                            <li class="list-inline-item"><i class="fa-regular fa-heart text-danger"></i> {{ $article->likes }}</li>
                            <li class="list-inline-item"><i class="fa-regular fa-comment text-primary"></i> {{ $article->comments }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="d-flex justify-content-center fw-bold">
                {{ $articles->links('pagination::bootstrap-5') }}
            </div>

            </div>

            <!-- Yan Panel -->
            @include('frontend.blog.sidebar')
        </div>
    </div>

@endsection
