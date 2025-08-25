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
            @auth
                <div class="col-12 mb-4">
                    <div class="alert alert-success d-flex align-items-center shadow-sm" role="alert">
                        <i class="fa fa-user-circle fa-2x me-3"></i>
                        <div>
                            <strong>Merhaba, {{ Auth::user()->name }}!</strong>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Blog Listesi -->
            <div class="col-lg-8 mb-4">
                @foreach([1,2,3] as $i)
                <div class="card single_post mb-4 shadow-sm border-0">
                    <div class="card-body">
                        <div class="img-post mb-3">
                            <img src="https://picsum.photos/800/280?random={{ $i }}" class="img-fluid rounded" alt="Blog Görseli">
                        </div>
                        <h3 class="h5 fw-bold">
                            <a href="#" class="text-decoration-none text-dark">Lorem Ipsum Blog Başlığı {{ $i }}</a>
                        </h3>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque euismod, nisi vel consectetur cursus, nisl erat dictum enim, nec facilisis erat nulla ut erat. Suspendisse potenti. Etiam vitae turpis nec velit cursus dictum.
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-success btn-sm rounded-pill px-4">Devamını Oku</a>
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item text-uppercase small pe-3 border-end text-secondary">Kategori</li>
                                <li class="list-inline-item"><i class="fa-regular fa-heart text-danger"></i> {{ rand(10,99) }}</li>
                                <li class="list-inline-item"><i class="fa-regular fa-comment text-primary"></i> {{ rand(50,200) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
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
                            <a href="#" class="badge bg-light border text-dark px-3 py-2">Eğitim</a>
                        </div>
                    </div>
                </div>

                <!-- Popüler Gönderiler -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Popüler Gönderiler</div>
                    <div class="card-body">
                        @foreach([1,2,3] as $i)
                        <div class="d-flex mb-3 align-items-center">
                            <img src="https://picsum.photos/60/60?random={{ $i+20 }}" class="me-3 rounded shadow-sm" alt="Popüler Gönderi">
                            <div>
                                <p class="mb-1 fw-semibold">Lorem Popüler Gönderi {{ $i }}</p>
                                <small class="text-muted">22 Haziran 202{{ $i }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- En Son Gönderiler -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">En Son Gönderiler</div>
                    <div class="card-body">
                        @foreach([1,2,3] as $i)
                        <div class="d-flex mb-3 align-items-center">
                            <img src="https://picsum.photos/60/60?random={{ $i+20 }}" class="me-3 rounded shadow-sm" alt="Popüler Gönderi">
                            <div>
                                <p class="mb-1 fw-semibold">Lorem Son Gönderi {{ $i }}</p>
                                <small class="text-muted">22 Haziran 202{{ $i }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- E-posta Bülteni -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Yeni Yazılardan Haberdar Ol!</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="E-posta adresiniz">
                            <button class="btn btn-success"><i class="fa fa-paper-plane"></i></button>
                        </div>
                        <small class="text-muted d-block mt-2">Blogumuza abone olun ve bu sayede en yeni yazılar e-posta kutunuza gelsin.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
