<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Yazıyı Güncelle</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&family=Inter:wght@400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>
<body>
    <div class="container my-5">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header fw-bold">
                        <h3 class="h5 fw-bold mb-4" style="padding-top: 15px;"><i class="fa fa-edit me-2"></i> Yazıyı Güncelle</h3>
                    </div>
                    <div class="card-body">
                        <form id="edit-article-form" action="{{ route('dashboard.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Başlık</label>
                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title', $article->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">İçerik</label>
                                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="5" style="min-height:150px; resize: vertical;" required>{{ old('content', $article->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label fw-semibold">Görsel</label>

                                @if($article->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $article->image) }}"
                                             class="img-thumbnail"
                                             style="max-width: 200px;"
                                             alt="Mevcut görsel">
                                        <p class="text-muted small mt-1">Mevcut görsel</p>
                                    </div>
                                @endif

                                <div class="input-group">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                           id="image" name="image" accept="image/*" onchange="previewFile(event)">
                                </div>
                                <small class="form-text text-muted">Yeni görsel seçmezseniz mevcut görsel korunur. Maksimum: 5MB</small>
                                @error('image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                                <!-- Önizleme -->
                                <div class="mt-3" id="image-preview" style="display:none;">
                                    <p class="fw-bold mb-1">Yeni Görsel:</p>
                                    <img src="#" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                    <button type="button" class="btn btn-sm btn-danger mt-2" onclick="clearImage()">
                                        <i class="fa fa-times"></i> Görseli Kaldır
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category', $article->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @role('admin')
                                <div class="mb-3">
                                    <label for="status" class="form-label">Durum</label>
                                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="active" {{ old('status', $article->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="passive" {{ old('status', $article->status) == 'passive' ? 'selected' : '' }}>Pasif</option>
                                        <option value="waiting" {{ old('status', $article->status) == 'waiting' ? 'selected' : '' }}>Beklemede</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                <input type="hidden" name="status" value="{{ $article->status }}">
                            @endrole

                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                <i class="fa fa-check me-1"></i> Yazıyı Güncelle
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // CKEditor'u textarea üzerinde başlat
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                const form = document.querySelector('#edit-article-form');
                form.addEventListener('submit', () => {
                    // Form submit olmadan önce CKEditor içeriğini textarea'ya aktar
                    document.querySelector('#content').value = editor.getData();
                });
            })
            .catch(error => console.error(error));

        // Görsel önizleme fonksiyonu
        function previewFile(event) {
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');
            const file = event.target.files[0];

            if(file) {
                // Dosya boyutu kontrolü (5MB)
                if(file.size > 5242880) {
                    alert('Dosya boyutu 5MB\'dan büyük olamaz!');
                    event.target.value = '';
                    preview.style.display = 'none';
                    return;
                }

                // Dosya tipi kontrolü
                if(!file.type.match('image.*')) {
                    alert('Lütfen sadece görsel dosyası seçiniz!');
                    event.target.value = '';
                    preview.style.display = 'none';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                img.src = '#';
            }
        }

        // Görseli kaldırma fonksiyonu
        function clearImage() {
            const fileInput = document.getElementById('image');
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');

            fileInput.value = '';
            img.src = '#';
            preview.style.display = 'none';
        }
    </script>
</body>
</html>
