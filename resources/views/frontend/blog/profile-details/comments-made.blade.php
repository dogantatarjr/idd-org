@extends('frontend.blog.profile-details.profile-details')

@section('my-comments-sit', 'active')
@section('topbar-icon', 'fas fa-comments')
@section('topbar-header', 'Yapılan Yorumlar')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($comments->count())
                <table class="table table-hover align-middle">
                    <thead class="table-secondary">
                        <tr class="text-center" style="border-radius: 0.5rem 0.5rem 0 0; overflow: hidden;">
                            <th class="text-center rounded-top-start" style="border-top-left-radius: 0.5rem;">Yazı</th>
                            <th class="text-center">Yorum</th>
                            <th class="text-center">Tarih</th>
                            <th class="text-center rounded-top-end" style="border-top-right-radius: 0.5rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr class="{{ $comment->article?->status !== 'active' ? 'table-secondary' : '' }}">
                                <td class="py-4 px-4 align-middle">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt text-primary me-2"></i>
                                        <a href="{{ route('blog.show', $comment->article->id) }}" class="fw-semibold text-decoration-none text-dark" target="_blank">
                                            {{ Str::limit($comment->article?->title ?? '-', 30) }}
                                        </a>
                                    </div>
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    <span class="text-secondary fst-italic">"{{ Str::limit($comment->content, 80) }}"</span>
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    <span class="badge bg-light text-dark border">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $comment->created_at?->format('d.m.Y H:i') ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 align-middle text-end">
                                    <a href="{{ route('blog.show', $comment->article?->id ?? 0) }}#comment-{{ $comment->id }}" class="btn btn-outline-success btn-sm" target="_blank" title="Yazıyı Görüntüle">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center fw-bold mt-4">
                    {{ $comments->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center p-5">
                    <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Henüz hiç yorum yapmadınız.</h5>
                    <p class="text-muted">Blog yazılarına yorum yaparak görüşlerinizi paylaşabilirsiniz.</p>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
