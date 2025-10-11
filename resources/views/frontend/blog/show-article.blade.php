@extends('frontend.master')

@section('title', 'Blog')

@section('blog-sit', 'active')

@section('content')

    <style>
        .like-btn {
            cursor: pointer;
            transition: transform 0.1s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .like-btn:hover {
            transform: scale(1.1);
        }

        .like-btn.liked .fa-heart {
            color: #dc3545 !important;
            animation: heartBeat 0.3s ease;
        }

        @keyframes heartBeat {
            0% {
                transform: scale(1);
            }
            25% {
                transform: scale(1.3);
            }
            50% {
                transform: scale(1.1);
            }
            75% {
                transform: scale(1.4);
            }
            100% {
                transform: scale(1);
            }
        }

        .like-particles {
            position: absolute;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 5px;
            height: 5px;
            background: #dc3545;
            border-radius: 50%;
            animation: particleFloat 0.8s ease-out forwards;
        }

        @keyframes particleFloat {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translate(var(--tx), var(--ty)) scale(0);
                opacity: 0;
            }
        }
    </style>

    <div class="blog-page container my-5">
        <div class="row">

            @if(session('success-comment'))
                <div class="alert alert-success">
                    {{ session('success-comment') }}
                </div>
            @endif

            @php
                if($article->user->status != 'active'){
                    $article->user->name = 'Anonim Yazar';
                }
            @endphp

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

                        {!! $article->content !!}

                        <hr>

                        <div class="d-flex justify-content-{{ $article->status === 'active' ? 'end' : 'between' }} align-items-center mt-3">
                            <div style="position: relative;">
                                @php
                                    $likedArticles = session()->get('liked_articles', []);
                                    $isLiked = in_array($article->id, $likedArticles);
                                @endphp
                                <span class="like-btn {{ $isLiked ? 'liked' : '' }}" onclick="toggleLike({{ $article->id }}, this)" data-liked="{{ $isLiked ? 'true' : 'false' }}">
                                    <i class="fa-{{ $isLiked ? 'solid' : 'regular' }} fa-heart text-danger me-2"></i>
                                    <span class="like-count">{{ $article->likes }}</span>
                                </span>
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
                            @php
                                $isAuthor = optional($comment->user)->id === optional($article->user)->id;
                                $isCommentOwner = optional($comment->user)->id === optional(Auth::user())->id;
                            @endphp

                            <div class="mb-3">

                                <!-- Ana yorum -->
                                <div class="mb-2 {{ $isAuthor ? 'text-success' : '' }}">
                                    <div class="d-flex justify-content-left align-items-center">

                                        <i class="fa fa-user me-2"></i>
                                        <strong>{{ $comment->user->name ?? 'Anonim Kullanıcı' }}</strong>
                                        <span class="text-muted ms-2" style="font-size: 0.85rem;">{{ $comment->created_at->format('d.m.Y H:i') }}</span>

                                        <!-- Yanıtla ikonu -->
                                        <a href="javascript:void(0);" style="text-decoration: none;" onclick="toggleReplyForm({{ $comment->id }})" title="Yanıtla">
                                            <i class="fa fa-reply text-success ms-2"></i>
                                        </a>

                                        <!-- Ana yorum için üç nokta dropdown -->
                                        @if ($isCommentOwner)
                                            <div class="dropdown ms-2">
                                                <button class="btn btn-link text-secondary p-0" type="button" id="dropdownMenuButton{{ $comment->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $comment->id }}">
                                                    <a href="javascript:void(0);" class="dropdown-item" onclick="editComment({{ $comment->id }})">
                                                        <i class="fa fa-pencil-square text-success me-2"></i> Düzenle
                                                    </a>
                                                    <a href="javascript:void(0);" class="dropdown-item" onclick="deleteReply({{ $comment->id }})">
                                                        <i class="fa fa-trash text-danger me-2"></i> Sil
                                                    </a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                    <p class="mb-1 {{ $isAuthor ? 'text-success' : '' }} mt-2">{{ $comment->content }}</p>
                                </div>

                                <!-- Yanıt formu (varsayılan gizli) -->
                                <form action="{{ route('comments.add', $article->id) }}" method="POST" class="mt-2 d-none" id="reply-form-{{ $comment->id }}">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">

                                    <p class="fw-bold"><i class="fa fa-user me-2"></i> {{ $user->name }}</p>

                                    <div class="mb-2">
                                        <textarea name="content" class="form-control" rows="2" placeholder="Yanıtınızı yazın..."></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-outline-success">Yanıtla!</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleReplyForm({{ $comment->id }})">İptal</button>
                                    <div style="padding-bottom: 15px;"></div>
                                </form>

                                <!-- Ana yorum düzenleme formu (varsayılan gizli) -->
                                <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="mt-2 d-none" id="edit-comment-form-{{ $comment->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <div class="mb-2">
                                        <textarea name="content" class="form-control" rows="2">{{ $comment->content }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-outline-success">Güncelle!</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editComment({{ $comment->id }})">İptal</button>
                                    <div style="padding-bottom: 15px;"></div>
                                </form>

                                <!-- Child yorumlar -->
                                @if($comment->children && $comment->children->count())
                                    <button class="btn btn-link btn-sm mb-2 ms-4" type="button" onclick="toggleChildren({{ $comment->id }})" id="toggle-btn-{{ $comment->id }}">
                                        Yanıtları Göster
                                    </button>

                                    <div class="text-muted mb-3 ms-4 d-none" id="children-{{ $comment->id }}">
                                        @foreach($comment->children as $child)
                                            @php
                                                $isAuthorChild = optional($child->user)->id === optional($article->user)->id;
                                                $isCommentOwnerChild = optional($child->user)->id === optional(Auth::user())->id;
                                            @endphp

                                            <div class="mb-2 {{ $isAuthorChild ? 'text-success' : '' }}">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <i class="fa fa-user me-2"></i>
                                                    <strong>{{ $child->user->name ?? 'Anonim Kullanıcı' }}</strong>
                                                    <span class="text-muted ms-2" style="font-size: 0.85rem;">{{ $child->created_at->format('d.m.Y H:i') }}</span>

                                                    <!-- Child için üç nokta dropdown -->
                                                    @if ($isCommentOwnerChild)
                                                        <div class="dropdown ms-2">
                                                            <button class="btn btn-link text-secondary p-0" type="button" id="dropdownMenuButtonChild{{ $child->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-h"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonChild{{ $child->id }}">
                                                                <a href="javascript:void(0);" class="dropdown-item" onclick="editReply({{ $child->id }})">
                                                                    <i class="fa fa-pencil-square text-success me-2"></i> Düzenle
                                                                </a>
                                                                <a href="javascript:void(0);" class="dropdown-item" onclick="deleteReply({{ $child->id }})">
                                                                    <i class="fa fa-trash text-danger me-2"></i> Sil
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <p class="mb-1 ms-4">{{ $child->content }}</p>

                                                <!-- Child düzenleme formu (varsayılan gizli) -->
                                                <form action="{{ route('comments.update', $child->id) }}" method="POST" class="mt-2 d-none" id="edit-reply-form-{{ $child->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="comment_id" value="{{ $child->id }}">
                                                    <div class="mb-2">
                                                        <textarea name="content" class="form-control" rows="2">{{ $child->content }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-outline-success">Güncelle!</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editReply({{ $child->id }})">İptal</button>
                                                    <div style="padding-bottom: 15px;"></div>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
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
        function toggleLike(articleId, element) {
            const isLiked = element.getAttribute('data-liked') === 'true';
            const heart = element.querySelector('.fa-heart');
            const likeCount = element.querySelector('.like-count');
            const currentCount = parseInt(likeCount.textContent);

            if (!isLiked) {
                element.classList.add('liked');
                heart.classList.remove('fa-regular');
                heart.classList.add('fa-solid');
                createParticles(element);
                likeCount.textContent = currentCount + 1;
                element.setAttribute('data-liked', 'true');
            } else {
                element.classList.remove('liked');
                heart.classList.remove('fa-solid');
                heart.classList.add('fa-regular');
                likeCount.textContent = currentCount - 1;
                element.setAttribute('data-liked', 'false');
            }

            fetch('/addLike', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: 'article_id=' + articleId
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.likes !== undefined) {
                    likeCount.textContent = data.likes;
                }
            })
            .catch(error => {
                if (!isLiked) {
                    element.classList.remove('liked');
                    heart.classList.remove('fa-solid');
                    heart.classList.add('fa-regular');
                    element.setAttribute('data-liked', 'false');
                    likeCount.textContent = currentCount;
                } else {
                    element.classList.add('liked');
                    heart.classList.remove('fa-regular');
                    heart.classList.add('fa-solid');
                    element.setAttribute('data-liked', 'true');
                    likeCount.textContent = currentCount;
                }
            });
        }

        function createParticles(element) {
            const particleCount = 8;
            const particles = document.createElement('div');
            particles.className = 'like-particles';

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                const angle = (Math.PI * 2 * i) / particleCount;
                const velocity = 30 + Math.random() * 20;
                const tx = Math.cos(angle) * velocity;
                const ty = Math.sin(angle) * velocity;

                particle.style.setProperty('--tx', `${tx}px`);
                particle.style.setProperty('--ty', `${ty}px`);

                particles.appendChild(particle);
            }

            element.appendChild(particles);

            setTimeout(() => {
                particles.remove();
            }, 800);
        }

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

        function deleteReply(replyId) {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu yanıtı silmek istediğinize emin misiniz?",
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

        function deleteReply(replyId) {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu yanıtı silmek istediğinize emin misiniz?",
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
