<div class="col-lg-8 mb-4">
    @foreach($articles as $article)
    <div class="card single_post mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="img-post mb-3">
                <img src="{{ $article->image }}"
                    class="img-fluid rounded" alt="article-image">
            </div>
            <h3 class="h5 fw-bold">
                <a href="{{ route('blog', $article->id) }}" class="text-decoration-none text-dark">
                    {{ $article->title }}
                </a>
            </h3>
            <p class="text-muted">
                {{ Str::limit($article->content, 300) }}
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('blog.show', $article->id) }}" class="btn btn-outline-success btn-sm rounded-pill px-4">
                    Devamını Oku
                </a>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item text-uppercase small pe-3 border-end text-secondary">
                        {{ $article->category}}
                    </li>
                    <li class="list-inline-item"><i class="fa-regular fa-heart text-danger"></i> {{ $article->likes }}</li>
                    <li class="list-inline-item"><i class="fa-regular fa-comment text-primary"></i> {{ $article->comments }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
