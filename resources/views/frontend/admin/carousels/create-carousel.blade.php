@extends('frontend.admin.master')

@section('topbar-header', 'Yeni carousel Ekle')

@section('topbar-icon', 'fas fa-plus')

@section('dashboard-sit', 'active')

@section('content')

    <div class="container my-5">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header fw-bold">
                        <h3 class="h5 fw-bold mb-4" style="padding-top: 15px;">
                            <i class="fa fa-plus me-2"></i> Yeni Carousel Ekle
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="create-carousel-form" action="{{ route('dashboard.carousels.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Başlık</label>
                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Açıklama</label>
                                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="5" style="min-height:150px; resize: vertical;">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Carousel Linki</label>
                                <input type="url" id="link" name="link" class="form-control @error('link') is-invalid @enderror" required value="{{ old('link') }}">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Görsel</label>
                                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                                <small class="form-text text-muted">Carousel için bir görsel seçin.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Geri Dön
                                </a>
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    <i class="fas fa-save me-1"></i> Carousel Ekle
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#content'), {
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
                const form = document.querySelector('#create-carousel-form');
                form.addEventListener('submit', function(e) {
                    const data = editor.getData();

                    if (!data.trim()) {
                        e.preventDefault();
                        alert('Lütfen açıklama alanını doldurun!');
                        return false;
                    }

                    document.querySelector('#content').value = data;
                });
            })
            .catch(error => console.error(error));
    });
</script>
