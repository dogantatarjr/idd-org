<div class="col-12 mb-4">
    <h2 class="fw-bold">Blog Anasayfası</h2>
</div>

<div class="col-lg-8 mb-4">

    @role('writer|admin')
        @include('frontend.blog.create-article')
    @endrole

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

                $text = $article->content;

                $words = Str::words($text, $maxWords, '');

                $lastPeriodPos = strrpos($words, '.');

                if ($lastPeriodPos !== false) {
                    $words = substr($words, 0, $lastPeriodPos + 1) . '..';
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
                        {{ $categories->where('id', $article->category_id)->first()->name }}
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
