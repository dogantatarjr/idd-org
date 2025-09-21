@extends('frontend.admin.master')

@section('topbar-header', 'Blog Yorumları')
@section('topbar-icon', 'fas fa-comments')
@section('comments-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">

            @if(session('success-comment'))
                <div class="alert alert-success">
                    {{ session('success-comment') }}
                </div>
            @endif

            <table class="table table-hover text-center" style="border-radius: 10px; overflow: hidden;">
                <thead class="align-middle" style="background-color: #6c757d; text-align: center;">
                    <tr>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px; text-align: center;">Yorum ID</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px; text-align: center;">Yorumu Yapan</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px; text-align: center;">Yorum</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px; text-align: center;">Yazıya Git</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px; text-align: center;">Tarih</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px; text-align: center;">Yorumu Sil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr class="text-center align-middle">
                            <th scope="row" style="padding: 15px; vertical-align: middle;">{{ $comment->id }}</th>
                            <td style="padding: 15px; word-break: break-word; white-space: normal; vertical-align: middle;">
                                {{ $comment->user->name }}
                            </td>
                            <td style="padding: 15px; word-break: break-word; white-space: normal; vertical-align: middle;">
                                "{{ $comment->content }}"
                            </td>
                            <td style="padding: 15px; word-break: break-word; white-space: normal; vertical-align: middle;">
                                <a href="{{ route('blog.show', $comment->article->id) }}" class="btn btn-sm btn-success mb-1 go-article-button">
                                    <i class="fas fa-external-link-square"></i>
                                </a>
                            </td>
                            <td style="padding: 15px; word-break: break-word; white-space: normal; vertical-align: middle;">
                                {{ $comment->created_at->format('d-m-Y H:i') }}
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger mb-1 delete-comment-button" onclick="deleteReply({{ $comment->id }})">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center fw-bold">
                {{ $comments->links('pagination::bootstrap-5') }}
            </div>

            <br><br>

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
