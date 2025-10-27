@extends('frontend.master')

@section('title', 'Kayıt Ol')

@section('blog-sit', 'active')

@section('content')

<br><br>

<!-- Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger mt-3 text-center">
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<br><br><br>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="mb-4 text-center">
            <img src="idd-logo.png" alt="logo" class="img-fluid" style="max-width: 150px;">
        </div>

        <h2 class="text-center mb-4">Kayıt Ol</h2>

        <form action="{{ route('register') }}" method="POST" id="register-form">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Ad-Soyad</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    placeholder="Adınızı ve soyadınızı girin..."
                    required
                    value="{{ old('name') }}"
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-posta Adresi</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    placeholder="E-posta adresinizi girin..."
                    required
                    value="{{ old('email') }}"
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Şifrenizi girin..."
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Şifreyi Onayla</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    placeholder="Şifrenizi tekrar girin..."
                    required
                >
            </div>

            <!-- reCAPTCHA v2 Checkbox -->
            <div class="mb-3">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                @error('g-recaptcha-response')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success w-100" onclick="register()">Kayıt Ol!</button>

            <div class="mt-3 text-center">
                <small>
                    Zaten bir hesabınız var mı? <a href="/login">Giriş Yap</a>
                </small>
            </div>
        </form>
    </div>
</div>

<br><br><br>

<!-- Google reCAPTCHA v2 script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    function register(){
        Swal.fire({
            title: 'Kayıt oluyor...',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
            willClose: () => {
                document.getElementById('register-form').submit();
            }
        });
    }
</script>

@endsection
