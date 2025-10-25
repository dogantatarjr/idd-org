@extends('frontend.master')

@section('title', 'Kampanyalarımız')

@section('projects-sit', 'active')

@section('content')

    <div class="text-center fw-bold text-success mb-5" style="padding-top: 50px">
        <i class="fas fa-bullhorn fa-4x mb-3"></i>
        <h1><b>Kampanyalarımız</b></h1>
    </div>

    <section class="container" style="padding-bottom: 50px">
        <div class="row g-4">
            @forelse ($campaigns as $index => $campaign)
                <div class="col-12 mb-4">
                    <div class="card shadow-sm border-0 {{ $index % 2 == 1 ? 'flex-row-reverse' : 'flex-row' }} h-100">
                        <img src="{{ asset('storage/' . $campaign->image) }}"
                            class="img-fluid"
                            alt="{{ $campaign->name }}"
                            style="width: 600px; object-fit: cover;">
                        <div class="card-body d-flex flex-column h-100 justify-content-between">
                            <div style="padding-bottom: 15px;">
                                <h4 class="card-title fw-semibold" style="padding-bottom: 5px;">{{ $campaign->name }}</h4>
                                <div class="card-text">
                                    {!! $campaign->description !!}
                                </div>
                            </div>
                            <a href="{{ $campaign->link }}" target="_blank" class="btn btn-success align-self-end">
                                <i class="fas fa-external-link" style="padding-right: 5px;"></i> Detayları Gör
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        Şu anda aktif kampanya bulunmamaktadır.
                    </div>
                </div>
            @endforelse
        </div>
    </section>

@endsection
