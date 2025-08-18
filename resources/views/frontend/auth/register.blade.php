@extends('frontend.master')

@section('title', 'Kayıt Ol')

@section('blog-sit', 'active')

@section('content')

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="mb-4 text-center">
            <img src="idd_logo.png" alt="logo" class="img-fluid" style="max-width: 150px;">
        </div>

        <h2 class="text-center mb-4">Kayıt Ol</h2>

        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Ad Soyad</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Adınızı girin..." required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-posta Adresi</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-posta adresinizi girin..." required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Şifrenizi girin..." required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Şifreyi Onayla</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Şifrenizi tekrar girin..." required>
            </div>

            <button type="submit" class="btn btn-success w-100">Kayıt Ol</button>

            <div class="mt-3 text-center">
                <small>
                    Zaten bir hesabınız var mı? <a href="/login">Giriş Yap</a>
                </small>
            </div>
        </form>

    </div>
</div>

@endsection
