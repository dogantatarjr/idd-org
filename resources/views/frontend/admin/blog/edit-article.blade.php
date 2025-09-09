<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Yazıyı Güncelle</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Open Sans Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Google Fonts: Montserrat & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="card mb-4 shadow-sm border-0 mx-auto" style="max-width: 500px;">
                <div class="card-header fw-bold">
                    <br>
                    <h3 class="h5 fw-bold mb-4"><i class="fa fa-edit" style="padding-right: 5px"></i> Yazıyı Güncelle</h3>
                    <form action="{{ route('dashboard.articles.update', $article->id) }}" method="POST">
                        @csrf

                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Başlık</label>
                            <input type="text" id="title" name="title" class="form-control" required value="{{ $article->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">İçerik</label>
                            <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $article->content) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Görsel URL</label>
                            <input type="text" id="image" name="image" class="form-control" required value="{{ $article->image }}">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select id="category" name="category" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $article->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Durum</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="active" {{ $article->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="passive" {{ $article->status == 'passive' ? 'selected' : '' }}>Pasif</option>
                                <option value="waiting" {{ $article->status == 'waiting' ? 'selected' : '' }}>Beklemede</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success rounded-pill px-4">Yazıyı güncelle!</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
