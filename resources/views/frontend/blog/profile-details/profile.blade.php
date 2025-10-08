@extends('frontend.blog.profile-details.profile-details')

@section('account-details-sit', 'active')
@section('topbar-icon', 'fas fa-user')
@section('topbar-header', 'Profil Bilgileri')

@section('content')

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header" style="background-color: #6c757d; color: white;">
            <h5 class="mb-0">
                <i class="fas fa-user" style="margin-right: 10px;"></i>{{ $user->roles->first()->name === 'admin' ? 'Admin' : ($user->roles->first()->name === 'writer' ? 'Yazar' : 'Kullanıcı') }} Bilgileri
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">İsim</span>
                        <input type="text" class="form-control" value="{{ $user->name }}" style="outline: none; box-shadow: none;" readonly>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editNameModal">
                            <i class="fas fa-edit"></i> Düzenle
                        </button>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">E-posta</span>
                        <input type="text" class="form-control" value="{{ $user->email }}" style="outline: none; box-shadow: none;" readonly>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editEmailModal">
                            <i class="fas fa-edit"></i> Düzenle
                        </button>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Şifre</span>
                        <input type="password" class="form-control" value="********" style="outline: none; box-shadow: none;" readonly>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                            <i class="fas fa-edit"></i> Değiştir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- İsim Düzenleme Modal -->
<div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('profile.update.name') }}" method="POST" id="nameForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editNameModalLabel">İsim Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Yeni İsim</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary submit-btn" data-form="nameForm">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- E-posta Düzenleme Modal -->
<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('profile.update.email') }}" method="POST" id="emailForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmailModalLabel">E-posta Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Yeni E-posta</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_password_email" class="form-label">Mevcut Şifre</label>
                        <input type="password" class="form-control" id="current_password_email" name="current_password" required>
                        <small class="text-muted">Güvenlik için mevcut şifrenizi girin</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary submit-btn" data-form="emailForm">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Şifre Değiştirme Modal -->
<div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('profile.update.password') }}" method="POST" id="passwordForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasswordModalLabel">Şifre Değiştir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Mevcut Şifre</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Yeni Şifre</label>
                        <input type="password" class="form-control" id="new_password" name="password" required>
                        <small class="text-muted">En az 8 karakter olmalıdır</small>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary submit-btn" data-form="passwordForm">Şifreyi Değiştir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.submit-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Değişiklikleri kaydetmek istiyor musunuz?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Evet',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(btn.dataset.form).submit();
                }
            });
        });
    });
</script>

@endsection
