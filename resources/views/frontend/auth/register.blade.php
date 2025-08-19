@extends('frontend.master')

@section('title', 'Kayıt Ol')

@section('blog-sit', 'active')

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

@section('content')

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="mb-4 text-center">
            <img src="idd_logo.png" alt="logo" class="img-fluid" style="max-width: 150px;">
        </div>

        <h2 class="text-center mb-4">Kayıt Ol</h2>

        <form action="{{ route('register') }}" method="POST">
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

            <button type="submit" class="btn btn-success w-100">Kayıt Ol!</button>

            <div class="mt-3 text-center">
                <small>
                    Zaten bir hesabınız var mı? <a href="/login">Giriş Yap</a>
                </small>
            </div>
        </form>
    </div>
</div>

<br><br><br>

@endsection
