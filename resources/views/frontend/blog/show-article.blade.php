@extends('frontend.master')

@section('title', 'Blog')

@section('blog-sit', 'active')

@section('auth-section')

    @auth
        <div class="d-none d-lg-flex align-items-center">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
            </form>
            <a class="btn btn-danger btn-lg mx-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Çıkış Yap</a>
        </div>
    @endauth

    @guest
        <div class="d-none d-lg-flex align-items-center">
            <a class="btn btn-success btn-lg mx-2" href="/login">Giriş Yap</a>
            <a class="btn btn-success btn-lg mx-2" href="/register">Kayıt Ol</a>
        </div>
    @endguest

@endsection

@section('content')

    <div class="blog-page container my-5">
        <div class="row">

            @if(session('success-comment'))
                <div class="alert alert-success">
                    {{ session('success-comment') }}
                </div>
            @endif

            <div class="col-lg-8 mb-4">
                <div class="card single_post shadow-sm border-0">
                    <img src="{{ $article->image }}" class="card-img-top rounded" alt="article-image">
                    <br>
                    <div class="card-body">
                        <h1 class="h3 fw-bold mb-3">{{ $article->title }}</h1>
                        <div class="text-muted small mb-4">
                            <i class="fa fa-user me-2"></i> {{ $article->user->name }}
                            <span class="mx-2">|</span>
                            <i class="fa fa-calendar me-2"></i> {{ $article->created_at->format('d.m.Y') }}
                            <span class="mx-2">|</span>
                            <i class="fa fa-folder-open me-2"></i> {{ $article->category->name }}
                            @role('admin')
                                @if ($article->status === 'waiting')
                                    &nbsp;&nbsp;&nbsp;
                                    <span class="me-2 badge badge-pill"
                                        style="background-color: {{ $article->status === 'active' ? 'green' : ($article->status === 'passive' ? 'gray' : 'orange') }}; color: white;">
                                        {{ $article->status }}
                                    </span>
                                @endif
                            @endrole
                        </div>

                        {!! nl2br(e($article->content)) !!}

                        <hr>

                        <div class="d-flex justify-content-{{ $article->status === 'active' ? 'end' : 'between' }} align-items-center mt-3">
                            <div>
                                <i class="fa-regular fa-heart text-danger me-2"></i> {{ $article->likes }}
                                <i class="fa-regular fa-comment text-primary ms-4 me-2"></i> {{ $article->comments }}
                            </div>
                            @role('admin')
                                @if ($article->status === 'waiting')
                                    <form action="{{ route('dashboard.articles.approve', $article->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-outline-warning">
                                            <i class="fa fa-check me-2"></i> Yazıyı Onayla!
                                        </button>
                                    </form>
                                @endif
                            @endrole
                        </div>
                    </div>
                </div>

                <!-- Yorumlar -->
                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-header bg-gray fw-bold">Yorumlar</div>
                    <div class="card-body">

                        <p class="fw-bold"><i class="fa fa-user" style="padding-right: 5px;"></i> {{ $user->name }}</p>

                        <!-- Yorum ekleme formu -->
                        <form action="{{ route('comments.add', $article->id) }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <div class="mb-3">
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Yorumunuzu yazın...">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" style="padding-right: 5px;"></i> Gönder</button>
                            </div>
                        </form>

                        <hr>

                        <!-- Yorumlar listesi -->
                        @forelse($article->articleComments as $comment)
                            <div class="mb-3">

                                @php
                                    $isAuthor = optional($comment->user)->id === optional($article->user)->id;
                                @endphp

                                <i class="fa fa-user {{ $isAuthor ? 'text-success' : '' }}" style="padding-right: 10px;"></i></i><strong>{{ $comment->user->name ?? 'Anonim Kullanıcı' }}</strong>

                                <!-- Yanıtla ikonu -->
                                <a href="javascript:void(0);" style="text-decoration: none;" onclick="toggleReplyForm({{ $comment->id }})" title="Yanıtla">
                                    <i class="fa fa-reply text-success ms-2"></i>
                                </a>

                                @php
                                    $isCommentOwner = optional($comment->user)->id === optional(Auth::user())->id;
                                @endphp

                                <!-- Yorum düzenleme ikonu -->
                                @if ($isCommentOwner)
                                    <a href="javascript:void(0);" style="text-decoration: none;" onclick="editComment({{ $comment->id }})" title="Düzenle">
                                        <i class="fa fa-pencil-square text-success ms-2"></i>
                                    </a>
                                @endif

                                <br>

                                <p class="mb-1" style="padding-top: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $comment->content }}</p>
                                @if($comment->children && $comment->children->count())
                                    <button class="btn btn-link btn-sm mb-2 ms-4" type="button" onclick="toggleChildren({{ $comment->id }})" id="toggle-btn-{{ $comment->id }}">
                                        Yanıtları Göster
                                    </button>

                                    <div class="text-muted mb-3 ms-4 d-none" id="children-{{ $comment->id }}">
                                        @foreach($comment->children as $child)

                                            @php
                                                $isAuthorChild = optional($child->user)->id === optional($article->user)->id;
                                            @endphp

                                            @php
                                                $isCommentOwner = optional($child->user)->id === optional(Auth::user())->id;
                                            @endphp

                                            <div class="mb-2 {{ $isAuthorChild ? 'text-success' : '' }}">
                                                <i class="fa fa-user" style="padding-right: 10px;"></i><strong>{{ $child->user->name ?? 'Anonim Kullanıcı' }}</strong>
                                                @if ($isCommentOwner)
                                                    <a href="javascript:void(0);" style="text-decoration: none;" onclick="editReply({{ $child->id }})" title="Düzenle">
                                                        <i class="fa fa-pencil-square text-success ms-2"></i>
                                                    </a>
                                                @endif
                                                <br>
                                                <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $child->content }}</p>
                                            </div>

                                            <!-- Yanıt düzenleme formu (varsayılan olarak gizli) -->
                                            <form action="{{ route('comments.update', $child->id) }}" method="POST" class="mt-2 d-none" id="edit-reply-form-{{ $child->id }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="comment_id" value="{{ $child->id }}">
                                                <div class="mb-2">
                                                    <textarea name="content" class="form-control" rows="2">{{ $child->content }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-outline-success">Güncelle</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editReply({{ $child->id }})">İptal</button>
                                                <div style="padding-bottom: 15px;"></div>
                                            </form>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Yanıt formu (varsayılan olarak gizli) -->
                            <form action="{{ route('comments.add', $article->id) }}" method="POST" class="mt-2 d-none" id="reply-form-{{ $comment->id }}">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">

                                <p class="fw-bold"><i class="fa fa-user" style="padding-right: 5px;"></i> {{ $user->name }}</p>

                                <div class="mb-2">
                                    <textarea name="content" class="form-control" rows="2" placeholder="Yanıtınızı yazın..."></textarea>
                                </div>

                                <button type="submit" class="btn btn-sm btn-outline-success">Yanıtla</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleReplyForm({{ $comment->id }})">İptal</button>
                                <div style="padding-bottom: 15px;"></div>
                            </form>

                            <!-- Yorum düzenleme formu (varsayılan olarak gizli) -->
                            <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="mt-2 d-none" id="edit-comment-form-{{ $comment->id }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <div class="mb-2">
                                    <textarea name="content" class="form-control" rows="2">{{ $comment->content }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-success">Güncelle</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editComment({{ $comment->id }})">İptal</button>
                                <div style="padding-bottom: 15px;"></div>
                            </form>

                        @empty
                            <p class="text-muted">Bu yazıya henüz yorum yapılmamış.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            @include('frontend.blog.sidebar')

        </div>
    </div>

    <script>
        function toggleReplyForm(commentId) {
            const form = document.getElementById('reply-form-' + commentId);
            if (form.classList.contains('d-none')) {
                form.classList.remove('d-none');
            } else {
                form.classList.add('d-none');
            }
        }

        function toggleChildren(commentId) {
            const childrenDiv = document.getElementById('children-' + commentId);
            const btn = document.getElementById('toggle-btn-' + commentId);
            if (childrenDiv.classList.contains('d-none')) {
                childrenDiv.classList.remove('d-none');
                btn.textContent = 'Yanıtları Gizle';
            } else {
                childrenDiv.classList.add('d-none');
                btn.textContent = 'Yanıtları Göster';
            }
        }

        function editComment(commentId) {
            const form = document.getElementById('edit-comment-form-' + commentId);
            if (form.classList.contains('d-none')) {
                form.classList.remove('d-none');
            } else {
                form.classList.add('d-none');
            }
        }

        function editReply(replyId) {
            const form = document.getElementById('edit-reply-form-' + replyId);
            if (form.classList.contains('d-none')) {
                form.classList.remove('d-none');
            } else {
                form.classList.add('d-none');
            }
        }
    </script>

@endsection
