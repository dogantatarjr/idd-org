@extends('frontend.master')

@section('title', 'Kampanyalarımız')

@section('projects-sit', 'active')

@section('content')

    <div class="text-center fw-bold text-success mb-5" style="padding-top: 50px">
        <i class="fas fa-bullhorn fa-4x mb-3"></i>
        <h1><b>Kampanyalarımız</b></h1>
    </div>

    <section class="container py-5">
        <div class="row g-4">

            @foreach ($campaigns as $index => $campaign)
                <div class="col-12 mb-4">
                    <div class="card shadow-sm border-0 {{ $index % 2 == 1 ? 'flex-row-reverse' : 'flex-row' }} h-100">
                        <img src="{{ $campaign->image }}"
                            class="img-fluid"
                            alt="Kampanya"
                            style="width: 400px; max-width: 60%; object-fit: cover;">
                        <div class="card-body d-flex flex-column h-100 justify-content-between">
                            <div style="padding-bottom: 15px;">
                                <h5 class="card-title fw-semibold">{{ $campaign->name }}</h5>
                                <p class="card-text">
                                    {{ $campaign->description }}
                                </p>
                            </div>
                            <a href="{{ $campaign->link }}" target="_blank" class="btn btn-success {{ $index % 2 == 1 ? 'align-self-start' : 'align-self-end' }}">
                                <i class="fas fa-external-link" style="padding-right: 5px;"></i> Detay Bilgi
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach


            <!-- Çift
            <div class="col-12">
                <div class="card shadow-sm border-0 flex-row-reverse h-100">
                    <img src="https://assets.change.org/photos/3/el/wq/viElWQayNLGpBBQ-800x450-noPad.jpg?1740924031"
                        class="img-fluid"
                        alt="Kampanya"
                        style="width: 400px; max-width: 60%; object-fit: contain">
                    <div class="card-body d-flex flex-column h-100 justify-content-between">
                        <div>
                            <h5 class="card-title fw-semibold">Plastik Poşete Son! Migros’u Karton Poşet Kullanımına Geçmeye Davet Ediyoruz!</h5>
                            <p class="card-text">
                                Her yıl dünya genelinde yaklaşık 500 milyar plastik poşet üretiliyor. Türkiye’de ise bu sayı yaklaşık 35 milyar! Tek kullanımlık plastik poşetler, ortalama 12 dakika kullanıldıktan sonra çöpe atılıyor. Ancak doğada yok olmaları 400 ila 1000 yıl sürebiliyor.
                                <br><br>
                                Plastik poşetler yalnızca çöp dağlarına dönüşmekle kalmıyor, aynı zamanda denizlere ve toprağa karışarak balıkların, kuşların ve diğer canlıların ölümüne yol açıyor. Dünya Doğayı Koruma Vakfı'na (WWF) göre, Akdeniz'deki deniz kaplumbağalarının %35'inin midesinde plastik atık bulunuyor. Türkiye'nin en büyük market zincirlerinden biri olan Migros, sürdürülebilir bir geleceğe katkıda bulunarak bu çevresel felakete dur diyebilir!
                            </p>
                        </div>
                        <br>
                        <a href="#" class="btn btn-success align-self-start">Detayları Gör</a>
                    </div>
                </div>
            </div> -->
        </div>
    </section>

@endsection
