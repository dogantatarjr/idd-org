@extends('frontend.admin.master')

@section('topbar-header', 'Blog Yorumları')
@section('topbar-icon', 'fas fa-comments')
@section('comments-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">

            @if(session('success-comment'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success-comment') }}
                </div>
            @endif

            @if($comments->count())
                <table class="table table-hover align-middle">
                    <thead class="table-secondary">
                        <tr class="text-center" style="border-radius: 0.5rem 0.5rem 0 0;">
                            <th class="text-center rounded-top-start" style="border-top-left-radius: 0.5rem;">ID</th>
                            <th class="text-center">Kullanıcı</th>
                            <th class="text-center">Yazı</th>
                            <th class="text-center">Yorum</th>
                            <th class="text-center">Tarih</th>
                            <th class="text-center">Üst Yorum</th>
                            <th class="text-center rounded-top-start" style="border-top-right-radius: 0.5rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr class="{{ $comment->user->status === 'passive' ? 'table-secondary' : '' }}">
                                <td class="text-center py-4 px-4 align-middle fw-semibold">{{ $comment->id }}</td>

                                <td class="text-center py-4 px-4 align-middle">
                                    {{ $comment->user->name ?? '-' }}
                                </td>

                                <td class="text-center py-4 px-4 align-middle">
                                    <a href="{{ route('blog.show', $comment->article->id) }}" target="_blank" class="text-decoration-none fw-semibold text-dark">
                                        {{ Str::limit($comment->article->title ?? '-', 30) }}
                                    </a>
                                </td>

                                <td class="text-center py-4 px-4 align-middle fst-italic text-secondary">
                                    "{{ Str::limit($comment->content, 60) }}"
                                </td>

                                <td class="text-center py-4 px-4 align-middle">
                                    <span class="badge bg-light text-dark border">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $comment->created_at->format('d.m.Y H:i') }}
                                    </span>
                                </td>

                                <td class="text-center py-4 px-4 align-middle">
                                    @if($comment->parent_comment_id)
                                        <span class="badge bg-success text-white">#{{ $comment->parent_comment_id }}</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>

                                <td class="text-end py-4 px-4 align-middle">
                                    <a href="{{ route('blog.show', $comment->article->id) }}#comment-{{ $comment->id }}"
                                       class="btn btn-outline-success btn-sm me-1"
                                       title="Yazıyı Görüntüle"
                                       target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="deleteReply({{ $comment->id }})"
                                            title="Yorumu Sil">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
                    <h5 class="text-muted">Henüz hiç yorum yapılmamış.</h5>
                    <p class="text-muted">Kullanıcıların yaptığı yorumlar burada listelenecektir.</p>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    function deleteReply(commentId) {
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu yorumu silmek istediğinize emin misiniz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Evet, sil',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/comments/delete/' + commentId;

                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = '{{ csrf_token() }}';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(tokenInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

@endsection
