<div class="card mb-4 shadow-sm border-0">
    <div class="card-header fw-bold">
        <br>
        <h3 class="h5 fw-bold mb-4"><i class="fa fa-pencil me-2"></i> Yeni Yazı Oluştur</h3>
        <form id="create-article-form" action="{{ route('blog.create-article') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Başlık</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">İçerik</label>
                <textarea id="content" name="content" class="form-control" rows="5"></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label fw-semibold">Görsel</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewFile(event)">
                </div>
                <small class="form-text text-muted">Yeni görsel seçmezseniz mevcut görsel korunur.</small>

                <!-- Önizleme -->
                <div class="mt-3" id="image-preview" style="display:none;">
                    <p class="fw-bold mb-1">Seçilen Görsel:</p>
                    <img src="#" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select id="category" name="category" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success rounded-pill px-4">Oluştur</button>
        </form>
        <br>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
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

            editor.ui.view.editable.element.style.minHeight = '300px';
            editor.ui.view.editable.element.style.maxHeight = '600px';

            form.addEventListener('submit', (e) => {
                const content = editor.getData().trim();
                document.querySelector('#content').value = content;
                if(content === '') {
                    e.preventDefault();
                    alert('İçerik alanı boş olamaz.');
                }
            });
        })
        .catch(error => console.error(error));
});

function previewFile(event) {
    const preview = document.getElementById('image-preview');
    const img = preview.querySelector('img');
    const file = event.target.files[0];

    if(file) {
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
</script>
