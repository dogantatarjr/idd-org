@extends('frontend.admin.master')

@section('topbar-header', 'Podcast Düzenle')

@section('topbar-icon', 'fas fa-edit')

@section('podcasts-sit', 'active')

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header fw-bold">
                    <h3 class="h5 fw-bold mb-4" style="padding-top: 15px;">
                        <i class="fa fa-edit me-2"></i> Podcast Düzenle
                    </h3>
                </div>
                <div class="card-body">
                    <form id="edit-podcast-form" action="{{ route('dashboard.podcasts.update', $podcast->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Başlık</label>
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title', $podcast->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Açıklama</label>
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5" style="min-height:150px; resize: vertical;">{{ old('description', $podcast->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="time" class="form-label">Süre</label>
                            <input type="text" id="time" name="time" class="form-control @error('time') is-invalid @enderror" placeholder="Örn: 25 dakika 11 saniye" value="{{ old('time', $podcast->time) }}" required>
                            @error('time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Podcast Linki</label>
                            <input type="url" id="link" name="link" class="form-control @error('link') is-invalid @enderror" required value="{{ old('link', $podcast->link) }}">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Görsel</label>
                            @if($podcast->image)
                                <div class="mb-2">
                                    <img src="{{ asset('/storage/app/public/' . $podcast->image) }}" alt="Current image" class="img-thumbnail" style="max-width: 200px;">
                                    <p class="text-muted small mt-1">Mevcut görsel</p>
                                </div>
                            @endif
                            <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">Yeni bir görsel seçmezseniz mevcut görsel korunur.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('dashboard.podcasts') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Geri Dön
                                </a>
                                <button type="button" id="delete-btn" class="btn btn-danger">
                                    <i class="fas fa-trash me-1"></i> Sil
                                </button>
                            </div>
                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                <i class="fas fa-save me-1"></i> Podcasti Güncelle
                            </button>
                        </div>
                    </form>

                    <form id="delete-form" action="{{ route('dashboard.podcasts.delete', $podcast->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|',
                        'bold', 'italic', 'underline',
                    ],
                    shouldNotGroupWhenFull: false
                }
            })
            .then(editor => {
                const form = document.querySelector('#edit-podcast-form');
                form.addEventListener('submit', function(e) {
                    const data = editor.getData();

                    if (!data.trim()) {
                        e.preventDefault();
                        alert('Lütfen açıklama alanını doldurun!');
                        return false;
                    }

                    document.querySelector('#description').value = data;
                });
            })
            .catch(error => console.error(error));

        document.getElementById('delete-btn').addEventListener('click', function() {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu podcast gönderisini silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Evet',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        });
    });
</script>
