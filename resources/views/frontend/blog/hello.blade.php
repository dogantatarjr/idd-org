@auth
    <div class="col-12 mb-4">
        <div class="alert alert-success d-flex align-items-center shadow-sm" role="alert">
            <i class="fa fa-user-circle fa-2x me-3"></i>
            <div>
                <strong>Merhaba, {{ Auth::user()->name }}!</strong>
            </div>
        </div>
    </div>
@endauth
