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
            @foreach($articles_like as $article_like)
            <div class="d-flex mb-3 align-items-center">
                <img src="{{ $article_like->image }}" style="width:50px; height:50px; object-fit:cover;" class="me-3 rounded shadow-sm" alt="Popüler Gönderi">
                <div>
                    <p class="mb-1 fw-semibold">
                        <a href="/blog/articles/{{ $article_like->id }}" class="text-decoration-none text-dark">
                            {{ $article_like->title }}
                        </a>
                    </p>
                    <small class="text-muted">{{ $article_like->category}}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- En Son Gönderiler -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-white fw-bold">En Son Gönderiler</div>
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
                    <small class="text-muted">{{ $article->category}}</small>
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
