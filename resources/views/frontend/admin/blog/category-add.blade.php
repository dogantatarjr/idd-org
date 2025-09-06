<!-- Category Add Modal -->
<div class="modal fade" id="categoryAddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #6c757d; color: white;">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle" style="margin-right: 10px;"></i>Yeni Kategori Ekle
                </h5>
            </div>
            <form method="POST" action="{{ route('dashboard.categories.add') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name" style="padding-bottom: 5px">Kategori Adı</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" style="padding-bottom: 5px">Durum</label><br>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active">Aktif</option>
                            <option value="passive">Pasif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeCategoryAdd()">Kapat</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
