<div class="col-lg-4">
    @auth
        <!-- Profil Kartı -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header fw-bold bg-success text-white">
                <i class="fa fa-user me-2"></i>Profilim
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                            style="width: 80px; height: 80px; margin: 0 auto;">
                        <i class="fa fa-user fs-3"></i>
                    </div>
                </div>

                <h6 class="fw-bold mb-1">{{ Auth::user()->name }}</h6>
                <small class="text-muted d-block mb-3">{{ Auth::user()->email }}</small>

                <div class="d-grid gap-2">
                    <a href="{{ route('blog.profile') }}" class="btn btn-outline-success btn-sm">
                        <i class="fa fa-info-circle me-1"></i> Profil Bilgileri
                    </a>
                    <form id="logout-form" method="POST" action="/logout" class="d-inline">
                        @csrf
                        <button type="button" onclick="logout()" class="btn btn-outline-danger btn-sm w-100">
                            <i class="fa fa-sign-out-alt me-1"></i> Çıkış Yap
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endauth

    @guest
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a class="btn btn-outline-success" href="{{ route('auth.login') }}">
                        <i class="fa fa-sign-in-alt me-1"></i> Giriş Yap
                    </a>
                    <a class="btn btn-outline-success" href="{{ route('auth.register') }}">
                        <i class="fa fa-user-plus me-1"></i> Kayıt Ol
                    </a>
                </div>
            </div>
        </div>
    @endguest

    @role('admin')
        <!-- Admin Paneli -->
        <div class="mb-4">
            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="btn btn-success w-100">
                    <i class="fa fa-house me-2"></i> Admin Paneline Git
                </a>
            </div>
        </div>
    @endrole

    <!-- Arama -->
    <form action="{{ route('blog.search') }}" method="GET">
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header fw-bold">Arama</div>
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fa fa-search"></i>
                    </span>
                    <input
                        type="text"
                        name="query"
                        class="form-control border-start-0"
                        placeholder="Ara..."
                        minlength="3"
                        required
                    >
                </div>
            </div>
        </div>
    </form>

    <!-- Kategoriler -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Kategoriler</div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 mb-2">
                @foreach ($categories as $category)
                <a href="/blog/categories/{{ $category->id }}" class="badge text-decoration-none bg-light border text-dark px-3 py-2">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Popüler Kategoriler -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Popüler Kategoriler</div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 mb-2">
                @foreach ($categories_popular as $category)
                    <a href="/blog/categories/{{ $category->id }}" class="badge text-decoration-none bg-light border text-dark px-3 py-2">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Popüler Gönderiler -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Popüler Gönderiler</div>
        <div class="card-body">
            @foreach($articles_like as $article_like)
            <div class="d-flex mb-3 align-items-center">
                <img src="{{ asset('storage/' . $article_like->image) }}" style="width:50px; height:50px; object-fit:cover;" class="me-3 rounded shadow-sm" alt="Popüler Gönderi">
                <div>
                    <p class="mb-1 fw-semibold">
                        <a href="/blog/articles/{{ $article_like->id }}" class="text-decoration-none text-dark">
                            {{ $article_like->title }}
                        </a>
                    </p>
                    <small class="text-muted">{{ $categories->where('id', $article_like->category_id)->first()->name }}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- En Son Gönderiler -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">En Son Gönderiler</div>
        <div class="card-body">
            @foreach($articles_latest as $article)
            <div class="d-flex mb-3 align-items-center">
                <img src="{{ asset('storage/' . $article->image) }}" style="width:50px; height:50px; object-fit:cover;" class="me-3 rounded shadow-sm" alt="Popüler Gönderi">
                <div>
                    <p class="mb-1 fw-semibold">
                        <a href="/blog/articles/{{ $article->id }}" class="text-decoration-none text-dark">
                            {{ $article->title }}
                        </a>
                    </p>
                    <small class="text-muted">{{ $categories->where('id', $article->category_id)->first()->name }}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- E-posta Bülteni
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Yeni Yazılardan Haberdar Ol!</div>
        <div class="card-body">
            <div class="input-group">
                <input type="email" class="form-control" placeholder="E-posta adresiniz">
                <button class="btn btn-success"><i class="fa fa-paper-plane"></i></button>
            </div>
            <small class="text-muted d-block mt-2">Blogumuza abone olun ve bu sayede en yeni yazılar e-posta kutunuza gelsin.</small>
        </div>
    </div> -->

    <!-- Sosyal Medya -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Bizi Takip Edin!</div>
        <div class="card-body d-flex gap-3">
            <a href="https://www.instagram.com/idd.org.tr/" target="_blank" class="text-success fs-4">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.linkedin.com/company/i%CC%87klim-de%C4%9Fi%C5%9Fmeden-de%C4%9Fi%C5%9F-%C5%9Firket" target="_blank" class="text-success fs-4">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="https://open.spotify.com/show/0FnjKhFwwugAHvTSIOiVS0?si=5fe08b0c2dde4414&nd=1&dlsi=b1f7cc70aa8e45e4" target="_blank" class="text-success fs-4">
                <i class="fab fa-spotify"></i>
            </a>
            <a href="https://www.youtube.com/@iklimdegismedendegis" target="_blank" class="text-success fs-4">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    </div>

    @if (Route::currentRouteName() == 'blog.category' || Route::currentRouteName() == 'blog.show')
        <div>
            <div class="text-center">
                <a href="{{ route('blog') }}" class="btn btn-outline-success">
                    <i class="fa fa-arrow-left me-2"></i> Blog Anasayfasına Dön
                </a>
            </div>
        </div>
    @endif
</div>

<script>
    function logout() {
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Çıkış yapmak istediğinize emin misiniz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Evet',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Çıkış yapılıyor...',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    willClose: () => {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        });
    }
</script>
