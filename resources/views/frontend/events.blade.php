@extends('frontend.master')

@section('title', 'Etkinliklerimiz')

@section('events-sit', 'active')

@section('content')

    <div class="text-center fw-bold text-success mb-5" style="padding-top: 50px">
        <i class="fas fa-calendar fa-4x mb-3"></i>
        <h1><b>Etkinliklerimiz</b></h1>
    </div>

    <section class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="#" class="card-img-top" alt="Kampanya">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold">Yapay Zeka Zirvesi 2025</h5>
                        <p class="card-text flex-grow-1">Teknolojinin geleceğini konuşacağımız büyük bir zirvede bir araya geliyoruz...</p>
                        <div class="text-muted small mb-2">
                            <p class="mb-0"><i class="fas fa-calendar" style="padding-right: 5px"></i> 21 Ekim 2025</p>
                            <p class="mb-0"><i class="fas fa-map-pin" style="padding-right: 5px"></i> İstanbul Kongre Merkezi</p>
                        </div>
                        <a href="#" class="btn btn-success mt-auto">Detayları Gör</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
