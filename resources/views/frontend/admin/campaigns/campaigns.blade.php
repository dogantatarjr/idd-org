@extends('frontend.admin.master')

@section('topbar-header', 'Kampanyalar')

@section('topbar-icon', 'fas fa-bullhorn')

@section('campaigns-sit', 'active')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-auto">

                @if(session('success-campaign'))
                    <div class="alert alert-success">
                        {{ session('success-campaign') }}
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($campaigns as $campaign)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $campaign->image) }}" class="card-img-top" alt="campaign-image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 5px;">{{ $campaign->name }}</h5>

                                    @php
                                        $maxWords = 25;
                                        $temp = strip_tags($campaign->description);
                                        $words = Str::words($temp, $maxWords, '...');

                                        $lastPeriodPos = strrpos($words, '.');

                                        if ($lastPeriodPos !== false) {
                                            $words = substr($words, 0, $lastPeriodPos + 1);
                                        } else {
                                            $words .= '...';
                                        }
                                    @endphp

                                    <p class="card-text">{{ $words }}</p>

                                    <a href="{{ $campaign->link }}" target="_blank" class="card-link text-decoration-none"><i class="fas fa-external-link"></i> Detayları Gör</a>
                                    <a href="/dashboard/campaigns/{{ $campaign->id }}/edit" class="card-link text-decoration-none"><i class="fas fa-edit"></i> Düzenle</a><br><br>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center fw-bold mt-4">
                    {{ $campaigns->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-end" style="padding-right: 30px;">
                <a href="{{ route('dashboard.campaigns.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Yeni Kampanya
                </a>
            </div>
        </div>

    </div>

@endsection
