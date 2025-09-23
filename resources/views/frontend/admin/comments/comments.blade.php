@extends('frontend.admin.master')

@section('topbar-header', 'Blog Yorumları')
@section('topbar-icon', 'fas fa-comments')
@section('comments-sit', 'active')

@section('content')

<style>
    /* Accordion açıkken mavi arkaplanı engelle */
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa !important;
        box-shadow: none !important;
    }
    .accordion-button:focus {
        box-shadow: none !important;
        border-color: transparent !important;
    }

    /* Üst yorum satırları + içindeki tablo ve hücreler */
    .parent-comment-row,
    .parent-comment-row table,
    .parent-comment-row td {
        background-color: #f8f9fa !important;
    }
    .parent-comment-row:hover,
    .parent-comment-row:hover table,
    .parent-comment-row:hover td {
        background-color: #ececec !important;
    }

    /* Alt yorum satırları */
    .child-comment {
        background-color: #fff;
    }
    .child-comment:hover {
        background-color: #f5f5f5;
    }

    /* Alt yorum olmayan satırlar için daha dar padding */
    .no-children-row {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">

            @if(session('success-comment'))
                <div class="alert alert-success">
                    {{ session('success-comment') }}
                </div>
            @endif

            <div class="accordion" id="commentsAccordion">
                @php
                    $parentComments = collect();
                    $allChildComments = collect();

                    foreach($comments as $comment) {
                        if($comment->parent_comment_id === null) {
                            $parentComments->push($comment);
                        } else {
                            $allChildComments->push($comment);
                        }
                    }
                @endphp

                @foreach ($parentComments as $parentComment)
                    @php
                        $childComments = $allChildComments->where('parent_comment_id', $parentComment->id);
                        $hasChildren = $childComments->count() > 0;
                    @endphp

                    <div class="accordion-item mb-3 shadow-sm rounded-3">
                        <h2 class="accordion-header" id="heading{{ $parentComment->id }}">
                            @if($hasChildren)
                                <!-- Çocuk yorum varsa accordion -->
                                <button class="accordion-button collapsed py-2 parent-comment-row" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $parentComment->id }}"
                                        aria-expanded="false"
                                        aria-controls="collapse{{ $parentComment->id }}">
                                    <table class="table table-borderless mb-0 align-middle">
                                        <tr>
                                            <td style="width: 10%"><strong>{{ $parentComment->id }}</strong></td>
                                            <td style="width: 20%">{{ $parentComment->user->name }}</td>
                                            <td style="width: 35%">"{{ $parentComment->content }}"</td>
                                            <td style="width: 15%">{{ $parentComment->created_at->format('d-m-Y H:i') }}</td>
                                            <td style="width: 10%">
                                                <span class="badge bg-primary">{{ $childComments->count() }} Alt Yorum</span>
                                            </td>
                                            <td style="width: 10%" class="text-end">
                                                <a href="{{ route('blog.show', $parentComment->article->id) }}" class="btn btn-sm btn-success me-1">
                                                    <i class="fas fa-external-link-square"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="deleteReply({{ $parentComment->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </button>
                            @else
                                <!-- Çocuk yorum yoksa düz satır -->
                                <div class="px-3 no-children-row parent-comment-row d-flex align-items-center rounded-3">
                                    <table class="table table-borderless mb-0 align-middle w-100">
                                        <tr>
                                            <td style="width: 10%"><strong>{{ $parentComment->id }}</strong></td>
                                            <td style="width: 20%">{{ $parentComment->user->name }}</td>
                                            <td style="width: 35%">"{{ Str::limit($parentComment->content, 50, '...') }}"</td>
                                            <td style="width: 15%">{{ $parentComment->created_at->format('d-m-Y H:i') }}</td>
                                            <td style="width: 10%">
                                                <span class="badge bg-secondary">Alt Yorum Yok</span>
                                            </td>
                                            <td style="width: 10%" class="text-end">
                                                <a href="{{ route('blog.show', $parentComment->article->id) }}" class="btn btn-sm btn-success me-1">
                                                    <i class="fas fa-external-link-square"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="deleteReply({{ $parentComment->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </h2>

                        @if($hasChildren)
                            <div id="collapse{{ $parentComment->id }}" class="accordion-collapse collapse"
                                 aria-labelledby="heading{{ $parentComment->id }}"
                                 data-bs-parent="#commentsAccordion">
                                <div class="accordion-body p-3">
                                    <div class="p-3 rounded" style="background-color: #fff;">
                                        <h6 class="text-muted mb-3">Alt Yorumlar ({{ $childComments->count() }} adet)</h6>

                                        @foreach($childComments as $childComment)
                                            <div class="d-flex justify-content-between align-items-center py-2 px-3 mb-2 rounded child-comment">
                                                <div>
                                                    <strong>{{ $childComment->id }}</strong> –
                                                    <span>{{ $childComment->user->name }}</span> :
                                                    "<span>{{ Str::limit($childComment->content, 50, '...') }}</span>"
                                                    <small class="text-muted ms-2">{{ $childComment->created_at->format('d-m-Y H:i') }}</small>
                                                </div>
                                                <div>
                                                    <a href="{{ route('blog.show', $childComment->article->id) }}" class="btn btn-xs btn-success me-1">
                                                        <i class="fas fa-external-link-square"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-xs btn-danger" onclick="deleteReply({{ $childComment->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach

                @if($parentComments->count() == 0)
                    <div class="text-center p-4">
                        <h5 class="text-muted">Henüz hiç yorum yapılmamış.</h5>
                    </div>
                @endif

            </div>

            <div class="d-flex justify-content-center fw-bold mt-4">
                {{ $comments->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

<script>
    function deleteReply(replyId) {
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu yorumu silmek istediğinize emin misiniz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Evet',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/comments/delete/' + replyId;

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
