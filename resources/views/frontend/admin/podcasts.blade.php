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
                            <img src="" class="card-img-top" alt="podcast-image">
                            <div class="card-body">
                                <h5 class="card-title" style="padding-bottom: 5px;">{{ $podcast->title }}</h5>
                                <p class="card-text">{{ $podcast->description }}</p>
                                <a href="{{ $podcast->link }}" target="_blank" class="card-link text-decoration-none"><i class="fas fa-external-link-alt"></i> Podcast Linki</a>
                                <a href="/dashboard/podcasts/{{ $podcast->id }}/edit" class="card-link text-decoration-none"><i class="fas fa-edit"></i> Düzenle</a><br><br>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center fw-bold">
                {{ $podcasts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <br><br>

</div>

@endsection
