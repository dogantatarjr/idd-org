@extends('frontend.master')

@section('title', 'Kitap')

@section('projects-sit', 'active')

@section('content')

<style>
    .book-logo-section {
        padding: 40px 0;
        padding-top: 0px;
        background-color: #ffffff;
    }
    .book-logo-section .logo-about {
        text-align: left;
        padding-left: 2.5rem;
    }
    .book-logo-section .about-title {
        font-size: 2.8rem;
        font-weight: 700;
        letter-spacing: -1px;
        line-height: 1.1;
        color: #222;
        margin-bottom: 0.5rem;
        font-family: 'Montserrat', Arial, Helvetica, sans-serif;
    }
    .book-logo-section .about-desc {
        font-size: 1.1rem;
        color: #444;
        margin-bottom: 0;
        font-family: 'Inter', Arial, Helvetica, sans-serif;
    }
    .book-buttons {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .book-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 28px;
        font-family: 'Inter', Arial, Helvetica, sans-serif;
        font-size: 1.05rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-amazon {
        background-color: #FF9900;
        color: #ffffff;
    }
    .btn-amazon:hover {
        background-color: #e68a00;
        color: #ffffff;
        transform: translateY(-2px);
    }
    .btn-google {
        background-color: #4285F4;
        color: #ffffff;
    }
    .btn-google:hover {
        background-color: #3367D6;
        color: #ffffff;
        transform: translateY(-2px);
    }
    @media (max-width: 991px) {
        .book-logo-section .logo-about {
            text-align: center;
            margin-top: 2rem;
            padding-left: 0;
        }
        .book-buttons {
            justify-content: center;
        }
    }
    @media (max-width: 767px) {
        .book-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        .book-btn {
            justify-content: center;
            width: 100%;
        }
    }
</style>

    <div class="text-center fw-bold text-success mb-5" style="padding-top: 70px; background-color: #ffffff;">
        <i class="fas fa-book fa-4x mb-4"></i>
        <h1><b>Change Before Climate Change</b></h1>
    </div>

    <section class="book-logo-section">
        <div class="container">
            <br><br><br>
            <div class="row align-items-center">
                <div class="col-md-5 text-center" data-aos="fade-right">
                    <img src="kapak.png" alt="kapak" class="img-fluid" style="max-height: 450px;">
                </div>
                <div class="col-md-7 logo-about" data-aos="fade-left">
                    <div class="about-title">
                        Kitap Özeti
                    </div>
                    <br>
                    <div class="about-desc">
                        İklim değişikliği yolculuğu, her eylem ve eylemsizliğin geleceğin tablosuna bir fırça darbesi attığı dinamik bir gezegende geçen destansı bir maceradır. Doğal olarak, ekonominin ekolojiyle birlikte dans etmeyi öğreneceği ve hareketsiz kalmanın bedelinin kimsenin istemediği bir geleceğe bilet olacağı bir dünya düşünün. Bu, tarımın hava koşullarının ritmine uyum sağladığı, sağlık hizmetlerinin doğanın attığı sürprizlere dayanmak için çabaladığı bir alandır.
                    </div>
                    <br>
                    <div class="about-desc">
                        Öyleyse bir pelerin giyin (tabii ki çevre dostu olanından) ve bu iklim macerasını, büyük ya da küçük her eylemin, hepimizin bu sağlıklı gezegende sonsuza kadar mutlu yaşadığımız muhteşem bir finale doğru bir adım olduğu destansı bir dönüşüme çevirelim. Bu, birlik, eylem ve biraz da eğlencenin hikâyesidir, çünkü dünyayı kurtarmanın biraz da eğlenceli olamayacağını kim söylemiş?
                    </div>

                    <div class="book-buttons">
                        <a href="https://www.amazon.com/Change-Before-Climate-Aydan-Comba/dp/B0CV7DLCHG" target="_blank" class="book-btn btn-amazon">
                            <i class="fab fa-amazon"></i>
                            Kitabımızın Amazon Sayfası
                        </a>
                        <a href="https://play.google.com/store/books/details?id=bv0iEQAAQBAJ" target="_blank" class="book-btn btn-google">
                            <i class="fab fa-google-play"></i>
                            Kitabımızın Google Play Sayfası
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
    </section>

@endsection
