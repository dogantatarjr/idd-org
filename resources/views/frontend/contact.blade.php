@extends('frontend.master')

@section('title', 'İletişim')
@section('contact-sit', 'active')

@section('content')
<div class="container contact-section">
    <div class="row justify-content-center align-items-start" style="padding-top: 40px;">
        <div class="col-lg-5 col-md-6 mb-5 text-center text-md-start d-flex flex-column justify-content-start align-items-center align-items-md-start">
            <div class="text-center text-md-start fw-bold text-success mb-4" style="padding-top: 120px">
                <i class="fas fa-users fa-4x mb-4"></i>
                <h1><b>İletişim</b></h1>
            </div>
            <p class="contact-description px-3 px-md-0 text-center text-md-start">
                Bize her türlü görüş, öneri veya sorularınızı iletebilirsiniz.<br> İletişim formunu doldurarak ekibimizle hızlıca iletişime geçebilir, olabilecek en yakın zamanda bizden dönüş alabilirsiniz :)
            </p>
        </div>

        <div class="col-lg-7 col-md-6" style="padding-bottom: 13px;">
            <div class="text-center text-md-start mb-4">
                <h2 class="fw-bold text-success"><b>İletişim Formu</b></h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success mt-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf

                <div class="mb-4 form-floating">
                    <input type="text" class="form-control" id="name" placeholder="İsim" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <label for="name">İsim</label>
                </div>

                <div class="mb-4 form-floating">
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <label for="email">Email</label>
                </div>

                <div class="mb-4 form-floating">
                    <input type="text" class="form-control" id="subject" placeholder="Konu" name="subject" value="{{ old('subject') }}" required>
                    @error('subject')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <label for="subject">Konu</label>
                </div>

                <div class="mb-4 form-floating">
                    <textarea class="form-control" id="message" placeholder="Mesaj" name="message" rows="5" required>{{ old('message') }}</textarea>
                    @error('message')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <label for="message">Mesaj</label>
                </div>

                <!-- reCAPTCHA v2 Checkbox -->
                <div class="mb-4">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    @error('g-recaptcha-response')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-paper-plane" style="padding-right: 5px;"></i> Mesaj Gönder
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Google reCAPTCHA v2 script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
