<h2 class="fw-bold">Kategoriler</h2><br>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success-category') }}
                </div>
            @endif
            <table class="table table-hover" style="text-align: center; border-radius: 10px; overflow: hidden;">
                <thead style="background-color: #6c757d;">
                    <tr>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kategori ID</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kategori Adı</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Yazı Sayısı</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kategori Durumu</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kategoriyi Düzenle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row" style="padding: 15px;">{{ $category->id }}</th>
                            <td style="padding: 15px;">
                                <a href="javascript:void(0)" style="text-decoration: none; color: #007bff; cursor: pointer;"
                                    onclick="showCategoryDetails({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->created_at->format('d.m.Y H:i') }}', '{{ $category->status }}')">
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td style="padding: 15px; text-color: dark;">{{ \App\Models\Article::where('category_id', $category->id)->count() }}</td>
                            <td style="padding: 15px;">
                                <span class="badge badge-pill" style="background-color: {{ $category->status === 'active' ? 'green' : ($category->status === 'passive' ? 'gray' : 'red') }}; color: white;">{{ $category->status }}</span>
                            </td>
                            <td style="padding: 15px;">
                                <i class="fas fa-edit" href="javascript:void(0)" style="cursor: pointer; color: orange;"
                                    onclick="showCategoryEdit({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->status }}')">
                                </i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-success" data-toggle="modal" onclick="showCategoryAdd()">
                    <i class="fas fa-plus" href="javascript:void(0)"></i> Yeni Kategori
                </button>
            </div>
        </div>
    </div>
</div>
