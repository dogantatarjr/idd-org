<div class="card mb-4 shadow-sm border-0">
    <div class="card-header fw-bold">
        <br>
        <h3 class="h5 fw-bold mb-4"><i class="fa fa-pencil me-2"></i> Yeni Yazı Oluştur</h3>
        <form id="create-article-form" action="{{ route('blog.create-article') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Başlık</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">İçerik</label>
                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="5" style="min-height:150px; resize: vertical;">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Görsel</label>
                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewFile(event)">
                <small class="form-text text-muted">Maksimum: 5MB</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <!-- Önizleme -->
                <div class="mt-3" id="image-preview" style="display:none;">
                    <p class="fw-bold mb-1">Seçilen Görsel:</p>
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
                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success rounded-pill px-4">
                <i class="fa fa-check me-1"></i> Oluştur!
            </button>
        </form>
        <br>
    </div>
</div>

<style>
    .ck-editor__editable_inline {
        min-height: 300px !important;
        max-height: 600px !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        font-family: 'Inter', 'Montserrat', sans-serif !important;
        line-height: 1.4 !important;
    }

    .ck-editor__editable_inline strong,
    .ck-editor__editable_inline b {
        font-weight: 700 !important;
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.querySelector('#title');
        const categorySelect = document.querySelector('#category');

        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: [
                    'undo', 'redo',
                    '|',
                    'heading',
                    '|',
                    'bold', 'italic', 'underline',
                    '|',
                    'link', 'blockQuote',
                    '|',
                    'bulletedList', 'numberedList'
                ]
            })
            .then(editor => {
                const form = document.querySelector('#create-article-form');
                const editableElement = editor.ui.view.editable.element;

                editableElement.style.minHeight = '300px';
                editableElement.style.maxHeight = '600px';

                // localStorage'dan eski değerleri yükle
                const savedTitle = localStorage.getItem('article-title');
                const savedContent = localStorage.getItem('article-content');
                const savedCategory = localStorage.getItem('article-category');

                if(savedTitle) titleInput.value = savedTitle;
                if(savedContent) editor.setData(savedContent);
                if(savedCategory) categorySelect.value = savedCategory;

                // Başlık değişimini kaydet
                titleInput.addEventListener('input', (e) => {
                    localStorage.setItem('article-title', e.target.value);
                });

                // İçerik değişimini kaydet
                editor.model.document.on('change:data', () => {
                    localStorage.setItem('article-content', editor.getData());
                });

                // Kategori değişimini kaydet
                categorySelect.addEventListener('change', (e) => {
                    localStorage.setItem('article-category', e.target.value);
                });

                // Form gönderilince localStorage'u temizle
                form.addEventListener('submit', (e) => {
                    const content = editor.getData().trim();
                    document.querySelector('#content').value = content;
                    if(content === '') {
                        e.preventDefault();
                        alert('İçerik alanı boş olamaz.');
                    } else {
                        localStorage.removeItem('article-title');
                        localStorage.removeItem('article-content');
                        localStorage.removeItem('article-category');
                    }
                });
            })
            .catch(error => console.error(error));
    });

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
