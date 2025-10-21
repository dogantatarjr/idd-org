@extends('frontend.master')

@section('title', 'İletişim')

@section('contact-sit', 'active')

@section('content')
    <div class="container contact-section">
        <div class="row">
            <div class="col-lg-5 col-md-6 mb-5 mb-md-0 text-success">
                <div class="icon-wrapper">
                    <i class="fas fa-users"></i>
                </div>
                <h1 class="contact-title text-success">İletişim</h1>
                <p class="contact-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quaerat autem corrupti asperiores accusantium et fuga! Facere excepturi, quo eos, nobis doloremque dolor labore expedita illum iusto, aut repellat fuga! Vestibulum ante eros, vulputate non eros in, commodo rhoncus neque.
                </p>
            </div>

            <div class="col-lg-7 col-md-6">

                @if(session('success'))
                    <div class="alert alert-success mt-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <br>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">İsim</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="form-label">Konu</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label">Mesaj</label>
                        <textarea class="form-control" id="message" name="message" required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn-send">Mesaj Gönder</button>
                </form>
            </div>
        </div>
    </div>
@endsection
