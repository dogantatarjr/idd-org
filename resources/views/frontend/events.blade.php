@extends('frontend.master')

@section('title', 'Etkinliklerimiz')

@section('events-sit', 'active')

@section('content')

    <div class="text-center fw-bold text-success mb-5" style="padding-top: 50px">
        <i class="fas fa-calendar fa-4x mb-3"></i>
        <h1><b>Etkinliklerimiz</b></h1>
    </div>

    <section class="container" style="padding-bottom: 50px">
        <div class="row g-4">
            @foreach ($events as $index => $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="Kampanya">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold">{{ $event->name }}</h5>
                            <p class="card-text flex-grow-1" style="padding-top: 5px;">{{ $event->description }}</p>
                            <div class="text-muted medium mb-2">
                                <p class="mb-0">
                                    <i class="fas fa-calendar" style="padding-right: 5px"></i>
                                    {{ \Carbon\Carbon::parse($event->time)->locale('tr')->translatedFormat('d F Y') }} | Saat {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
                                </p>
                                <p class="mb-0"><i class="fas fa-map-pin" style="padding-right: 5px"></i> {{ $event->place }}</p>
                            </div>
                            <a href="{{ $event->link }}" target="_blank" class="btn btn-success align-self-end">
                                <i class="fas fa-external-link" style="padding-right: 5px;"></i> Detayları Gör
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
