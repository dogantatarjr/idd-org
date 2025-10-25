<!-- Category Edit Modal -->
<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="categoryEditForm" method="POST" action="">
                @csrf

                @method('PUT')

                <div class="modal-header" style="background-color: #6c757d; color: white;">
                    <h5 class="modal-title">
                        <i class="fas fa-pencil" style="margin-right: 10px;"></i>Kategori Düzenle
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-category-id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label style="padding-bottom: 5px">Kategori Adı</label>
                                <input type="text" class="form-control" name="name" id="edit-category-name">
                            </div>
                            <div class="form-group mb-2">
                                <label style="padding-bottom: 5px">Durum</label>
                                <select class="form-control" name="status" id="edit-category-status">
                                    <option value="active">Aktif</option>
                                    <option value="passive">Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeCategoryEdit()">
                        <i class="close fas fa-times" type="button" data-dismiss="modal" style="margin-right: 5px;"></i>Kapat
                    </button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
