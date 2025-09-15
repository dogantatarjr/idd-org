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
        <p class="card-texts d-flex justify-content-between">
            <span>Yazar: {{ $article->user->name }}</span>
            <span class="badge badge-pill"
                style="background-color: {{ $article->status === 'active' ? 'green' : ($article->status === 'passive' ? 'gray' : 'orange') }}; color: white;">
                {{ $article->status }}
            </span>
        </p>
        <a href="/blog/articles/{{ $article->id }}" class="card-link text-decoration-none"><i class="fas fa-eye"></i> Görüntüle</a>
        <a href="/dashboard/articles/{{ $article->id }}/edit" class="card-link text-decoration-none"><i class="fas fa-edit"></i> Düzenle</a><br><br>
    </div>
    <div class="card-footer">
        <small class="text-body-secondary">En son güncelleme <b>{{ round($article->updated_at->diffInDays(\Carbon\Carbon::now('Europe/Istanbul'))) }} gün önce</b> gerçekleştirilmiştir.</small>
        <br><small class="text-body-secondary">Bu yazı <b>{{ round($article->created_at->diffInDays(\Carbon\Carbon::now('Europe/Istanbul'))) }} gün önce</b> oluşturulmuştur.</small>
    </div>
    </div>
</div>
