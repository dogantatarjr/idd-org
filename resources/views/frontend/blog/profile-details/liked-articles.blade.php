@extends('frontend.blog.profile-details.profile-details')

@section('likes-sit', 'active')

@section('topbar-icon', 'fas fa-heart')

@section('topbar-header', 'Beğenilen Yazılar')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">
            @if($likedArticles->count())
                <table class="table table-hover align-middle">
                    <thead class="table-secondary">
                        <tr class="text-center" style="border-radius: 0.5rem 0.5rem 0 0; overflow: hidden;">
                            <th class="text-center rounded-top-start" style="border-top-left-radius: 0.5rem;">Başlık</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Beğeni Sayısı</th>
                            <th class="text-center rounded-top-end" style="border-top-right-radius: 0.5rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($likedArticles as $article)
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
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="badge bg-light me-2 text-danger border">
                                            <i class="fas fa-heart me-1"></i>
                                            {{ $article->articleLikes->count() ?? 0 }}
                                        </span>
                                    </div>
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
            @else
                <div class="text-center p-5">
                    <i class="fas fa-heart fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Henüz hiç beğeniniz yok.</h5>
                    <p class="text-muted">Beğendiğiniz bir yazıya ulaşıp beğeni bırakabilirsiniz.</p>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
