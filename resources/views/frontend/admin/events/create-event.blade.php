@extends('frontend.admin.master')

@section('topbar-header', 'Yeni Etkinlik Ekle')

@section('topbar-icon', 'fas fa-plus')

@section('events-sit', 'active')

@section('content')

    <div class="container my-5">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header fw-bold">
                        <h3 class="h5 fw-bold mb-4" style="padding-top: 15px;">
                            <i class="fa fa-plus me-2"></i> Yeni Etkinlik Ekle
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="create-event-form" action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Etkinlik Adı</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Açıklama</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5" style="min-height:150px; resize: vertical;">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="time" class="form-label">Tarih ve Saat</label>
                                    <input type="datetime-local" id="time" name="time" class="form-control @error('time') is-invalid @enderror" required value="{{ old('time') }}">
                                    @error('time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="place" class="form-label">Mekan</label>
                                    <input type="text" id="place" name="place" class="form-control @error('place') is-invalid @enderror" required value="{{ old('place') }}" placeholder="Örn: İstanbul, Türkiye">
                                    @error('place')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Etkinlik Linki</label>
                                <input type="url" id="link" name="link" class="form-control @error('link') is-invalid @enderror" required value="{{ old('link') }}">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Görsel</label>
                                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                                <small class="form-text text-muted">Etkinlik için bir görsel seçin.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('dashboard.events') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Geri Dön
                                </a>
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    <i class="fas fa-save me-1"></i> Etkinlik Ekle
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
                const form = document.querySelector('#create-event-form');
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
    });
</script>
