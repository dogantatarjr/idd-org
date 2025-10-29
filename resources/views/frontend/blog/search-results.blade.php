@extends('frontend.master')

@section('title', 'Blog')

@section('blog-sit', 'active')

@section('content')

    <div class="blog-page container my-5">
        <div class="row">

            @include('frontend.blog.hello')

            <div class="col-lg-8 mb-4">
                @if ($articles->count() == 0)
                    <div class="text-center p-5">
                        <i class="fas fa-file fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">"{{ $query }}" aramanıza uygun sonuç bulunamadı.</h5>
                    </div>

                    <div>
                        <div class="text-center">
                            <a href="{{ route('blog') }}" class="btn btn-outline-success">
                                <i class="fa fa-arrow-left me-2"></i> Blog Anasayfasına Dön
                            </a>
                        </div>
                    </div>
                @else
                    <div class="col-12 mb-4">
                        <h2 class="fw-bold">"{{ $query }}" Aramasının Sonuçları:</h2>
                    </div>
                @endif

                @foreach($articles as $article)
                    <div class="card single_post mb-4 shadow-sm border-0">
                        <div class="card-body">
                            <div class="img-post mb-3">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}"
                                        class="img-fluid rounded object-fit-cover"
                                        style="height: 300px; width: 100%;"
                                        alt="{{ $article->title }}">
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                         style="height: 300px; width: 100%;">
                                        <i class="fas fa-image fa-3x text-white"></i>
                                    </div>
                                @endif
                            </div>

                            <h3 class="h5 fw-bold">{{ $article->title }}</h3>

                            @php
                                $maxWords = 50;

                                // Tüm &nbsp; karakterlerini boşlukla değiştir
                                $content = str_replace('&nbsp;', ' ', $article->content);

                                // Sadece header taglerini (h1-h6) nokta ile değiştir, diğer tüm tagleri düz kaldır
                                $temp = preg_replace('/<\/h[1-6]>/i', '. ', $content); // header kapanışlarını nokta ile değiştir
                                $temp = preg_replace('/<h[1-6][^>]*>/i', '', $temp); // header açılışlarını kaldır
                                $temp = strip_tags($temp); // diğer tüm tagleri kaldır

                                // Kelime sayısına göre kısalt
                                $words = Str::words($temp, $maxWords, '...');

                                $lastPeriodPos = strrpos($words, '.');

                                if ($lastPeriodPos !== false) {
                                    $words = substr($words, 0, $lastPeriodPos + 1);
                                }
                            @endphp

                            <p class="text-muted">
                                {{ $words }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('blog.show', $article->id) }}" class="btn btn-outline-success btn-sm rounded-pill px-4">
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
