<div class="card mb-4 shadow-sm border-0">
    <div class="card-header fw-bold">
        <br>
        <h3 class="h5 fw-bold mb-4"><i class="fa fa-pencil" style="padding-right: 5px"></i> Yeni Yazı Oluştur</h3>
        <form id="create-article-form" action="{{ route('blog.create-article') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Başlık</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">İçerik</label>
                <!-- required kaldırıldı, CKEditor içeriği submit sırasında kontrol edilecek -->
                <textarea id="content" name="content" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Görsel URL</label>
                <input type="text" id="image" name="image" class="form-control">
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
        .create(document.querySelector('#content'))
        .then(editor => {
            const form = document.querySelector('#create-article-form');
            form.addEventListener('submit', (e) => {
                // CKEditor içeriğini textarea'ya aktar
                const content = editor.getData().trim();
                document.querySelector('#content').value = content;

                // Eğer içerik boşsa submit'i durdur
                if(content === '') {
                    e.preventDefault();
                    alert('İçerik alanı boş olamaz.');
                }
            });
        })
        .catch(error => console.error(error));
});
</script>
