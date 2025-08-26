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
                            <i class="fa fa-folder-open me-2"></i> {{ $article->category }}
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
                            <button class="btn btn-success">Gönder</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Yan Panel -->
            <div class="col-lg-4">
                <!-- Arama -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-body">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Ara...">
                        </div>
                    </div>
                </div>

                <!-- Kategoriler -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Kategoriler</div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="badge bg-light border text-dark px-3 py-2">Teknoloji</a>
                            <a href="#" class="badge bg-light border text-dark px-3 py-2">Tasarım</a>
                            <a href="#" class="badge bg-light border text-dark px-3 py-2">Yazılım</a>
                            <a href="#" class="badge bg-light border text-dark px-3 py-2">Girişimcilik</a>
                        </div>
                    </div>
                </div>

                <!-- Popüler Gönderiler -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Popüler Gönderiler</div>
                    <div class="card-body">
                        @foreach([1,2,3] as $i)
                        <div class="d-flex mb-3 align-items-center">
                            <img src="https://picsum.photos/60/60?random={{ $i+30 }}" class="me-3 rounded shadow-sm" alt="Popüler Gönderi">
                            <div>
                                <p class="mb-1 fw-semibold">Lorem Popüler {{ $i }}</p>
                                <small class="text-muted">22 Haziran 202{{ $i }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
