@extends('frontend.admin.master')

@section('topbar-header', 'Etkinlikler')

@section('topbar-icon', 'fas fa-calendar-alt')

@section('events-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">

            @if(session('success-event'))
                <div class="alert alert-success">
                    {{ session('success-event') }}
                </div>
            @endif

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($events as $event)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('/storage/app/public/' . $event->image) }}" class="card-img-top" alt="event-image" style="object-fit: contain;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold" style="padding-bottom: 5px;">{{ $event->name }}</h5>

                                <div class="mb-0">
                                    <p class="text-muted small mb-1">
                                        <i class="fas fa-calendar" style="padding-right: 5px;"></i>
                                        {{ \Carbon\Carbon::parse($event->time)->locale('tr')->translatedFormat('d F Y') }}
                                    </p>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-map-marker-alt" style="padding-right: 5px;"></i>
                                        {{ $event->place }}
                                    </p>
                                </div>

                                @php
                                    $maxWords = 30;
                                    $temp = strip_tags($event->description);
                                    $words = Str::words($temp, $maxWords, '...');

                                    $lastPeriodPos = strrpos($words, '.');

                                    if ($lastPeriodPos !== false) {
                                        $words = substr($words, 0, $lastPeriodPos + 1);
                                    } else {
                                        $words .= '...';
                                    }
                                @endphp

                                <p class="card-text flex-grow-1">{{ $words }}</p>

                                <br><br>

                                <div class="position-absolute bottom-0 end-0 p-3">
                                    <div class="d-flex gap-2">
                                        <a href="{{ $event->link }}" target="_blank" class="btn btn-success btn-sm shadow-sm">
                                            <i class="fas fa-external-link-alt"></i> Detayları Gör
                                        </a>
                                        <a href="/dashboard/events/{{ $event->id }}/edit" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit"></i> Düzenle
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center fw-bold mt-4">
                {{ $events->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-end" style="padding-right: 30px;">
            <a href="{{ route('dashboard.events.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Yeni Etkinlik
            </a>
        </div>
    </div>

</div>

@endsection
