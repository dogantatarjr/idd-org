@extends('frontend.master')

@section('title', 'Kampanyalarımız')

@section('projects-sit', 'active')

@section('content')

    <div class="text-center fw-bold text-success mb-5" style="padding-top: 70px">
        <i class="fas fa-bullhorn fa-4x mb-3"></i>
        <h1><b>Kampanyalarımız</b></h1>
    </div>

    <section class="container" style="padding-bottom: 50px">
        <div class="row g-4">
            @forelse ($campaigns as $index => $campaign)
                <div class="col-12 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="row g-0 {{ $index % 2 == 1 ? 'flex-row-reverse' : '' }}">
                            <div class="col-md-5">
                                <img src="{{ asset('/storage/' . $campaign->image) }}"
                                    class="img-fluid w-100 h-100"
                                    alt="{{ $campaign->name }}"
                                    style="object-fit: cover; min-height: 300px;">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body d-flex flex-column h-100 justify-content-between p-4">
                                    <div class="mb-3">
                                        <h4 class="card-title fw-semibold mb-3">{{ $campaign->name }}</h4>
                                        <div class="card-text">
                                            {!! $campaign->description !!}
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <a href="{{ $campaign->link }}" target="_blank" class="btn btn-success">
                                            <i class="fas fa-external-link me-2"></i> Kampanyaya Git!
                                        </a>
                                    </div>
                                </div>
                            </div>
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
