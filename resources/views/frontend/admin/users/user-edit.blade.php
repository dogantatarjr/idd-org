<!-- User Edit Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="userEditForm" method="POST" action="">
                @csrf

                @method('PUT')

                <div class="modal-header" style="background-color: #6c757d; color: white;">
                    <h5 class="modal-title">
                        <i class="fas fa-user-circle" style="margin-right: 10px;"></i>Kullanıcı Düzenle
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-user-id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label class="mb-1">Kullanıcı Adı</label>
                                <input type="text" class="form-control" name="name" id="edit-user-name">
                            </div>
                            <div class="form-group">
                                <label class="mb-1">E-mail</label>
                                <input type="email" class="form-control" name="email" id="edit-user-email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label class="mb-1">Rol</label>
                                <select class="form-control" name="role" id="edit-user-role">
                                    <option value="admin">Admin</option>
                                    <option value="writer">Writer</option>
                                    <option value="user">User</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="mb-1">Durum</label>
                                <select class="form-control" name="status" id="edit-user-status">
                                    <option value="active">Aktif</option>
                                    <option value="passive">Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeUserEdit()">
                        <i class="close fas fa-times" type="button" data-dismiss="modal" style="margin-right: 5px;"></i>Kapat
                    </button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
