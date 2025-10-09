@extends('frontend.blog.profile-details.profile-details')

@section('my-articles-sit', 'active')
@section('topbar-icon', 'fas fa-file-alt')
@section('topbar-header', 'Yazılarım')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">

            @if(session('success-article'))
                <div class="alert alert-success">
                    {{ session('success-article') }}
                </div>
            @endif

            @if($articles->count())
                <table class="table table-hover align-middle">
                    <thead class="table-secondary">
                        <tr class="text-center" style="border-radius: 0.5rem 0.5rem 0 0; overflow: hidden;">
                            <th class="text-center rounded-top-start" style="border-top-left-radius: 0.5rem;">Başlık</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Durum</th>
                            <th class="text-center">Düzenle</th>
                            <th class="text-center">Tarih</th>
                            <th class="text-center rounded-top-end" style="border-top-right-radius: 0.5rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td class="py-4 px-4 align-middle">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt text-primary me-2"></i>
                                        <a href="{{ route('blog.show', $article->id) }}" class="fw-semibold text-decoration-none text-dark" target="_blank">
                                            {{ Str::limit($article->title, 30) }}
                                        </a>
                                    </div>
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    <span class="text-secondary">{{ $article->category->name ?? '-' }}</span>
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    @if($article->status === 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($article->status === 'waiting')
                                        <span class="badge bg-warning text-dark">Beklemede</span>
                                    @else
                                        <span class="badge bg-secondary">Pasif</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    <a href="{{ route('dashboard.articles.edit', $article->id) }}" class="btn btn-outline-warning btn-sm" title="Yazıyı Düzenle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                <td class="py-4 px-4 align-middle">
                                    <span class="badge bg-light text-dark border">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $article->created_at?->format('d.m.Y H:i') ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 align-middle text-end">
                                    <a href="{{ route('blog.show', $article->id) }}" class="btn btn-outline-success btn-sm" target="_blank" title="Yazıyı Görüntüle">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center fw-bold mt-4">
                    {{ $articles->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center p-5">
                    <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Henüz hiç yazınız yok.</h5>
                    <p class="text-muted">Yeni bir yazı oluşturarak paylaşabilirsiniz.</p>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
