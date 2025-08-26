@extends('frontend.master')

@section('title', 'Giriş Yap')

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
            <img src="idd-logo.png" alt="logo" class="img-fluid" style="max-width: 150px;">
        </div>

        <h2 class="text-center mb-4">Giriş Yap</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

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
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Beni hatırla</label>
            </div>

            <button type="submit" class="btn btn-success w-100">Giriş Yap!</button>

            <div class="mt-3 text-center">
                <small>
                    Henüz bir hesabınız yok mu? <a href="/register">Kayıt Ol</a>
                </small>
            </div>
        </form>
    </div>
</div>

<br>

@endsection
