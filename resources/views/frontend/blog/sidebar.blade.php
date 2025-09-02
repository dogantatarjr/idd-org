<div class="col-lg-4">
    <!-- Arama -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Arama</div>
        <div class="card-body">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Ara...">
            </div>
        </div>
    </div>

    <!-- Kategoriler -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Kategoriler</div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 mb-2">
                @foreach ($categories as $category)
                <a href="/blog/categories/{{ $category->id }}" class="badge bg-light border text-dark px-3 py-2">{{ $category->name }}</a>
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
                <img src="{{ $article_like->image }}" style="width:50px; height:50px; object-fit:cover;" class="me-3 rounded shadow-sm" alt="Popüler Gönderi">
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

    @if(!(Route::currentRouteName() == 'blog.category'))
        <!-- En Son Gönderiler -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header fw-bold">En Son Gönderiler</div>
            <div class="card-body">
                @foreach($articles as $article)
                <div class="d-flex mb-3 align-items-center">
                    <img src="{{ $article->image }}" style="width:50px; height:50px; object-fit:cover;" class="me-3 rounded shadow-sm" alt="Popüler Gönderi">
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
    @endif


    <!-- E-posta Bülteni -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Yeni Yazılardan Haberdar Ol!</div>
        <div class="card-body">
            <div class="input-group">
                <input type="email" class="form-control" placeholder="E-posta adresiniz">
                <button class="btn btn-success"><i class="fa fa-paper-plane"></i></button>
            </div>
            <small class="text-muted d-block mt-2">Blogumuza abone olun ve bu sayede en yeni yazılar e-posta kutunuza gelsin.</small>
        </div>
    </div>

    <!-- Sosyal Medya -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header fw-bold">Bizi Takip Edin</div>
        <div class="card-body d-flex gap-3">
            <a href="#" target="_blank" class="text-success fs-4">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" target="_blank" class="text-success fs-4">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="#" target="_blank" class="text-success fs-4">
                <i class="fab fa-spotify"></i>
            </a>
            <a href="#" target="_blank" class="text-success fs-4">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    </div>

    @if (Route::currentRouteName() == 'blog.category')
        <div>
            <div class="text-center">
                <a href="{{ route('blog') }}" class="btn btn-outline-success">
                    <i class="fa fa-arrow-left me-2"></i> Blog Anasayfasına Dön
                </a>
            </div>
        </div>
    @endif

    @role('admin')
        <!-- Admin Paneli -->
        <div>
            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="btn btn-success w-100">
                    <i class="fa fa-cog me-2"></i> Admin Paneline Git
                </a>
            </div>
        </div>
    @endrole
</div>
