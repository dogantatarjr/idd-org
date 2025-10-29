@extends('frontend.master')

@section('title', 'Podcast')

@section('projects-sit', 'active')

@section('content')

    <div class="text-center fw-bold text-success mb-5" style="padding-top: 70px">
        <i class="fas fa-microphone fa-4x mb-3"></i>
        <h1><b>IDD ORG Podcast</b></h1>
    </div>

    <section class="container" style="padding-bottom: 50px">
        <div class="row g-4">
            @foreach ($podcasts as $index => $podcast)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                        <img src="{{ asset('storage/' . $podcast->image) }}" class="card-img-top" alt="Podcast">
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h5 class="card-title fw-semibold mb-2">{{ $podcast->title }}</h5>

                            @if($podcast->time)
                                <p class="text-muted small mb-2">
                                    <i class="fas fa-clock" style="padding-right: 5px;"></i> {{ $podcast->time }}
                                </p>
                            @endif

                            <p class="card-text mb-1">{!! $podcast->description !!}</p>

                            <div class="mt-auto text-end">
                                <a href="{{ $podcast->link }}" target="_blank" class="btn btn-success">
                                    <i class="fas fa-external-link" style="padding-right: 5px;"></i> Bölümü Dinle!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
