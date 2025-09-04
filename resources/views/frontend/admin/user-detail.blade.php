<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #6c757d; color: white;">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle" style="margin-right: 10px;"></i>Kullanıcı Detayları
                </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header" style="background-color: #f8f9fa;">
                                <h6 class="mb-0">
                                    <i class="fas fa-info-circle" style="margin-right: 10px;"></i>Temel Bilgiler
                                </h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Kullanıcı ID:</strong> <span id="modal-user-id"></span></p>
                                <p><strong>Kullanıcı Adı:</strong> <span id="modal-user-name"></span></p>
                                <p><strong>E-mail:</strong> <span id="modal-user-email"></span></p>
                                <p><strong>Rol:</strong> <span id="modal-user-role"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header" style="background-color: #f8f9fa;">
                                <h6 class="mb-0">
                                    <i class="fas fa-calendar-alt" style="margin-right: 10px;"></i>Hesap Bilgileri
                                </h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Kayıt Tarihi:</strong> <span id="modal-user-created"></span></p>
                                <p><strong>Durum:</strong> <span id="modal-user-status"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeUserDetails()">
                    <i class="close fas fa-times" type="button" data-dismiss="modal" style="margin-right: 5px;"></i>Kapat
                </button>
            </div>
        </div>
    </div>
</div>
