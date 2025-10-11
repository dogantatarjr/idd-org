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
                        <form id="edit-article-form" action="{{ route('dashboard.articles.update', $article->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Başlık</label>
                                <input type="text" id="title" name="title" class="form-control" required value="{{ $article->title }}">
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">İçerik</label>
                                <textarea id="content" name="content" class="form-control" rows="5" style="min-height:150px; resize: vertical;" required>{{ old('content', $article->content) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Görsel URL</label>
                                <input type="text" id="image" name="image" class="form-control" required value="{{ $article->image }}">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select id="category" name="category" class="form-select" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @role('admin')
                                <div class="mb-3">
                                    <label for="status" class="form-label">Durum</label>
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="active" {{ $article->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="passive" {{ $article->status == 'passive' ? 'selected' : '' }}>Pasif</option>
                                        <option value="waiting" {{ $article->status == 'waiting' ? 'selected' : '' }}>Beklemede</option>
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="status" value="{{ $article->status }}">
                            @endrole

                            <button type="submit" class="btn btn-success rounded-pill px-4">Yazıyı Güncelle!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|',
                        'heading',
                        '|',
                        'fontfamily', 'fontsize',
                        '|',
                        'bold', 'italic', 'strikethrough', 'underline',
                        '|',
                        'link', 'blockQuote',
                        '|',
                        'bulletedList', 'numberedList'
                    ],
                    shouldNotGroupWhenFull: false
                }
            })
            .then(editor => {
                const form = document.querySelector('#edit-article-form');
                form.addEventListener('submit', () => {
                    document.querySelector('#content').value = editor.getData();
                });
            })
            .catch(error => console.error(error));
    </script>
</body>
</html>
