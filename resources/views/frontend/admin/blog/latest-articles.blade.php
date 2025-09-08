<h2 class="fw-bold">En Son Yazılar</h2><br>

@if(session('success-article'))
    <div class="alert alert-success">
        {{ session('success-article') }}
    </div>
@endif

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($articles as $article)
        <div class="col">
            <div class="card h-100">
            <img src="{{ $article->image }}" class="card-img-top" alt="article-image">
            <div class="card-body">
                <h5 class="card-title" style="padding-bottom: 5px;">{{ $article->title }}</h5>
                <p class="card-texts text-uppercase">{{ $categories->where('id', $article->category_id)->first()->name }}</p>

                @php
                    $maxWords = 25;

                    $text = $article->content;

                    $words = Str::words($text, $maxWords, '');

                    $lastPeriodPos = strrpos($words, '.');

                    if ($lastPeriodPos !== false) {
                        $words = substr($words, 0, $lastPeriodPos + 1) . '..';
                    } else {
                        $words .= '...';
                    }
                @endphp

                <p class="card-text">{{ $words }}</p>
                <p class="card-texts">Yazar: {{ $article->user->name }}</p>

                <a href="/blog/articles/{{ $article->id }}" class="card-link text-decoration-none"><i class="fas fa-eye"></i> Görüntüle</a>
                <a href="/dashboard/articles/{{ $article->id }}/edit" class="card-link text-decoration-none"><i class="fas fa-edit"></i> Düzenle</a>
            </div>
            <div class="card-footer">
                <small class="text-body-secondary">En son güncelleme ~{{ round($article->updated_at->diffInDays(\Carbon\Carbon::now('Europe/Istanbul'))) }} gün önce</small>
            </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center fw-bold">
    {{ $articles->links('pagination::bootstrap-5') }}
</div>
