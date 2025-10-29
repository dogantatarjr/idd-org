<div class="col">
    <div class="card h-100">
        <img src="{{ asset('/storage/app/public/' . $article->image) }}"
                 class="card-img-top"
                 alt="{{ $article->title }}">
        <div class="card-body">
            <h5 class="card-title" style="padding-bottom: 5px;">{{ $article->title }}</h5>
            <p class="card-texts text-uppercase">{{ $article->category->name }}</p>

            @php
                $maxWords = 25;

                // <p> tag'i hariç tüm HTML tag'lerini ve içindekileri kaldır
                $text = preg_replace_callback('/<([^p][^>]*)>.*?<\/\1>/', function($matches) {
                    return ''; // <p> hariç tüm tag'ler ve içi silinir
                }, $article->content);

                $temp = strip_tags($text);

                // Kelime sayısına göre kısalt
                $words = Str::words($temp, $maxWords, '...');

                $lastPeriodPos = strrpos($words, '.');

                if ($lastPeriodPos !== false) {
                    $words = substr($words, 0, $lastPeriodPos + 1);
                } else {
                    $words .= '...';
                }
            @endphp

            <p class="card-text">
                {{ $words }}
            </p>

            <p class="card-texts d-flex justify-content-between">
                <span><b>Yazar:</b> {{ $article->user->status === 'active' ? $article->user->name : 'Anonim Yazar' }}</span>
                <span class="badge badge-pill"
                    style="background-color: {{ $article->status === 'active' ? 'green' : ($article->status === 'passive' ? 'gray' : 'orange') }}; color: white;">
                    {{ ucfirst($article->status) }}
                </span>
            </p>
            <a href="{{ route('blog.show', $article->id) }}" class="card-link text-decoration-none">
                <i class="fas fa-eye"></i> Görüntüle
            </a>
            <a href="{{ route('dashboard.articles.edit', $article->id) }}" class="card-link text-decoration-none">
                <i class="fas fa-edit"></i> Düzenle
            </a>
        </div>
        <div class="card-footer">
            <small class="text-body-secondary">
                En son güncelleme <b>{{ $article->updated_at->diffForHumans() }}</b> gerçekleştirilmiştir.
            </small>
            <br>
            <small class="text-body-secondary">
                Bu yazı <b>{{ $article->created_at->diffForHumans() }}</b> oluşturulmuştur.
            </small>
        </div>
    </div>
</div>
