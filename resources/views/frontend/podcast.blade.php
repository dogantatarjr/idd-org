@extends('frontend.master')

@section('title', 'Podcast')

@section('projects-sit', 'active')

@section('content')

    <div class="text-center fw-bold text-success mb-5" style="padding-top: 50px">
        <i class="fas fa-podcast fa-4x mb-3"></i>
        <h1><b>IDD ORG Podcast</b></h1>
    </div>

    <section class="container" style="padding-bottom: 50px">
        <div class="row g-4">
            @foreach ($podcasts as $index => $podcast)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/' . $podcast->image) }}" class="card-img-top" alt="Podcast">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold">{{ $podcast->name }}</h5>
                            <p class="card-text flex-grow-1" style="padding-top: 5px;">{{ $podcast->description }}</p>
                            <a href="{{ $podcast->link }}" target="_blank" class="btn btn-success align-self-end">
                                <i class="fas fa-external-link" style="padding-right: 5px;"></i> Detayları Gör
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
