<!-- Category Details Modal -->
<div class="modal fade" id="categoryDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #6c757d; color: white;">
                <h5 class="modal-title">
                    <i class="fas fa-folder" style="margin-right: 10px;"></i>Kategori Detayları
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
                                <p><strong>Kategori ID:</strong> <span id="modal-category-id"></span></p>
                                <p><strong>Kategori Adı:</strong> <span id="modal-category-name"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header" style="background-color: #f8f9fa;">
                                <h6 class="mb-0">
                                    <i class="fas fa-calendar-alt" style="margin-right: 10px;"></i>Kategori Bilgileri
                                </h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Oluşturma Tarihi:</strong> <span id="modal-category-created"></span></p>
                                <p><strong>Durum:</strong> <span id="modal-category-status"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeCategoryDetails()">
                    <i class="close fas fa-times" type="button" data-dismiss="modal" style="margin-right: 5px;"></i>Kapat
                </button>
            </div>
        </div>
    </div>
</div>
