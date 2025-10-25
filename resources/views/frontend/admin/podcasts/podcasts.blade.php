@extends('frontend.admin.master')

@section('topbar-header', 'Podcastler')

@section('topbar-icon', 'fas fa-microphone')

@section('podcasts-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">

            @if(session('success-podcast'))
                <div class="alert alert-success">
                    {{ session('success-podcast') }}
                </div>
            @endif

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($podcasts as $podcast)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $podcast->image) }}" class="card-img-top" alt="podcast-image">
                            <div class="card-body">
                                <h5 class="card-title" style="padding-bottom: 5px;">{{ $podcast->title }}</h5>

                                @if($podcast->time)
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-clock" style="padding-right: 5px;"></i> {{ $podcast->time }}
                                    </p>
                                @endif

                                @php
                                    $maxWords = 25;
                                    $temp = strip_tags($podcast->description);
                                    $words = Str::words($temp, $maxWords, '...');

                                    $lastPeriodPos = strrpos($words, '.');

                                    if ($lastPeriodPos !== false) {
                                        $words = substr($words, 0, $lastPeriodPos + 1);
                                    } else {
                                        $words .= '...';
                                    }
                                @endphp

                                <p class="card-text">{{ $words }}</p>

                                <a href="{{ $podcast->link }}" target="_blank" class="card-link text-decoration-none"><i class="fas fa-external-link"></i> Detayları Gör</a>
                                <a href="/dashboard/podcasts/{{ $podcast->id }}/edit" class="card-link text-decoration-none"><i class="fas fa-edit"></i> Düzenle</a><br><br>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center fw-bold mt-4">
                {{ $podcasts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-end" style="padding-right: 30px;">
            <a href="{{ route('dashboard.podcasts.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Yeni Podcast
            </a>
        </div>
    </div>

</div>

@endsection
