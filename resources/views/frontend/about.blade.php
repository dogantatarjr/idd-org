@extends('frontend.master')

@section('title', 'Hakkımızda')

@section('about-sit', 'active')

@section('content')

<style>
    .about-logo-section {
        padding: 60px 0;
        background-color: #ffffff;
    }
    .about-logo-section .logo-about {
        text-align: left;
        padding-left: 2.5rem;
    }
    .about-logo-section .about-title {
        font-size: 2.8rem;
        font-weight: 700;
        letter-spacing: -1px;
        line-height: 1.1;
        color: #222;
        margin-bottom: 0.5rem;
        font-family: 'Montserrat', Arial, Helvetica, sans-serif;
    }
    .about-logo-section .about-desc {
        font-size: 1.1rem;
        color: #444;
        margin-bottom: 0;
        font-family: 'Inter', Arial, Helvetica, sans-serif;
    }
    .about-buttons {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .about-btn {
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
    .btn-green {
        background-color: #198754;
        color: #ffffff;
    }
    .btn-green:hover {
        background-color: #157347;
        color: #ffffff;
        transform: translateY(-2px);
    }
    .btn-outline-green {
        border: 2px solid #198754;
        color: #198754;
    }
    .btn-outline-green:hover {
        background-color: #198754;
        color: #ffffff;
        transform: translateY(-2px);
    }
    @media (max-width: 991px) {
        .about-logo-section .logo-about {
            text-align: center;
            margin-top: 2rem;
            padding-left: 0;
        }
        .about-buttons {
            justify-content: center;
        }
    }
    @media (max-width: 767px) {
        .about-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        .about-btn {
            justify-content: center;
            width: 100%;
        }
    }
</style>

<div class="text-center fw-bold text-success mb-5" style="padding-top: 70px; background-color: #ffffff;">
    <i class="fas fa-info-circle fa-4x mb-2"></i>
    <h1><b>Hakkımızda</b></h1>
</div>

<section class="about-logo-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center" data-aos="fade-right">
                <img src="{{ asset('idd-logo.png') }}" alt="about" class="img-fluid" style="max-height: 400px;">
            </div>
            <div class="col-md-7 logo-about" data-aos="fade-left">
                <div class="about-title">
                    Fikirleri eyleme, disiplinleri çözüme dönüştürüyoruz.
                </div>
                <br>
                <div class="about-desc" style="text-align: justify;">
                    <b><b>İklim Değişmeden Değiş (IDD ORG)</b></b>, iklim krizine dair farkındalığı artırmayı, bilgiye dayalı politikaları teşvik etmeyi ve toplumsal dönüşümü hızlandırmayı amaçlayan Türkiye’nin en kapsamlı iklim organizasyonudur. Bilim insanlarından sanatçılara, politika yapıcılardan yerel topluluklara kadar geniş bir ağla iş birliği yapar. Her projemiz, bilimsel doğruluğu, yaratıcı iletişimi ve toplumsal katılımı bir araya getirir. Çünkü biz inanıyoruz ki iklim kriziyle mücadele sadece sayılarla değil, hikâyelerle; sadece analizlerle değil, gerçek eylemlerle mümkündür.
                </div>
                <br>
                <div class="about-desc" style="text-align: justify;">
                    Eğitimlerden farkındalık kampanyalarına, araştırmalardan teknoloji projelerine kadar uzanan çok yönlü çalışmalarımızla, bireyleri iklim eylemine dahil ediyoruz. Bizim için her küçük adım, daha yaşanabilir bir dünya için büyük bir fark yaratır.
                </div>

                <div class="about-buttons">
                    <a href="https://www.instagram.com/idd.org.tr/" target="_blank" class="about-btn btn-green">
                        <i class="fas fa-seedling"></i>
                        Organizasyonumuzu Keşfet!
                    </a>
                    <a href="#teams-section" class="about-btn btn-outline-green">
                        <i class="fas fa-user"></i>
                        Ekibimize Katıl!
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="values-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-weight: 800; font-size: 2.3rem;" data-aos="fade-up">Değerlerimiz</h2>
        <div class="row justify-content-center g-4" style="max-width: 1400px; margin: 0 auto;">

            <div class="col-md-3 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="0">
                <div class="team-card">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-icon mb-3"><i class="fa fa-balance-scale" style="font-size: 2.8rem;"></i></div>
                            <div class="team-title">Adalet</div>
                        </div>
                        <div class="team-card-back">
                            <div class="team-desc mb-3">İklim eylemi, yalnızca doğayı değil, toplumu da kapsar. Hiç kimseyi geride bırakmadan, herkes için <b>adil</b> bir gelecek inşa edilir.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="100">
                <div class="team-card">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-icon mb-3"><i class="fa fa-search" style="font-size: 2.8rem;"></i></div>
                            <div class="team-title">Şeffaflık</div>
                        </div>
                        <div class="team-card-back">
                            <div class="team-desc mb-3">Veri, süreç ve kararlar paylaşılır; çünkü gerçek dönüşüm, <b>şeffaflık</b> ile başlar.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="200">
                <div class="team-card">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-icon mb-3"><i class="fa fa-cogs" style="font-size: 2.8rem;"></i></div>
                            <div class="team-title">Disiplinlerarası Düşünce</div>
                        </div>
                        <div class="team-card-back">
                            <div class="team-desc mb-3">Sorunları tek açıdan görmek yeterli değil. <b>Farklı disiplinleri</b> bir araya getirerek yenilikçi ve uygulanabilir çözümler üretilir.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="300">
                <div class="team-card">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-icon mb-3"><i class="fa fa-handshake" style="font-size: 2.8rem;"></i></div>
                            <div class="team-title">Dayanışma</div>
                        </div>
                        <div class="team-card-back">
                            <div class="team-desc mb-3">Kriz ortaksa çözüm de ortak olmalıdır. Yerel topluluklardan uluslararası iş birliklerine kadar <b>dayanışma</b> güçlendirilir, etki kalıcı hâle getirilir.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="teams-section" style="padding: 80px 0;">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-weight: 800; font-size: 2.3rem;" data-aos="fade-up">Ekibimize Katıl!</h2>
        <div class="row justify-content-center g-4" style="max-width: 1400px; margin: 0 auto;">

            <!-- Sosyal Medya Kartı -->
            <div class="col-md-3 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="0">
                <div class="team-card">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-icon mb-3"><i class="fab fa-instagram" style="font-size: 2.8rem;"></i></div>
                            <div class="team-title">Sosyal Medya ve İletişim Ekibi</div>
                        </div>
                        <div class="team-card-back">
                            <div class="team-desc mb-3">Instagram, Linkedin ve TikTok gibi sosyal mecralara içerik üreterek her kesimden insana ulaşıp iklim ve çevre bilinci yayar.</div>
                            <a href="https://forms.gle/k2hrur4W9jj8Sgwr7" target="_blank" class="btn btn-success team-join-btn">Ekibe Katıl!</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organizasyon Kartı -->
            <div class="col-md-3 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="100">
                <div class="team-card">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-icon mb-3"><i class="fas fa-users" style="font-size: 2.8rem;"></i></div>
                            <div class="team-title">Organizasyon Ekibi</div>
                        </div>
                        <div class="team-card-back">
                            <div class="team-desc mb-3">Alanında uzman kişiler ile iletişim kurup atölyeler organize ederek insanları bilinçlendirmeyi hedefler.</div>
                            <a href="https://forms.gle/YvQguePwDWXWm9Nf7" target="_blank" class="btn btn-success team-join-btn">Ekibe Katıl!</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proje/Kampanya Kartı -->
            <div class="col-md-3 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="200">
                <div class="team-card">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-icon mb-3"><i class="fas fa-bullhorn" style="font-size: 2.8rem;"></i></div>
                            <div class="team-title">Proje ve Kampanya Ekibi</div>
                        </div>
                        <div class="team-card-back">
                            <div class="team-desc mb-3">Kampanyalar çıkararak ve imza toplayarak iklim değişikliğine karşı somut adımlar atmak üzerine çalışır.</div>
                            <a href="https://forms.gle/SxuRTqA3FTGgyrqV9" target="_blank" class="btn btn-success team-join-btn">Ekibe Katıl!</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teknoloji Kartı -->
            <div class="col-md-3 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="300">
                <div class="team-card">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-icon mb-3"><i class="fas fa-laptop-code" style="font-size: 2.8rem;"></i></div>
                            <div class="team-title">Teknoloji Ekibi</div>
                        </div>
                        <div class="team-card-back">
                            <div class="team-desc mb-3">Organizasyonumuz bünyesinde yürütülen çalışmaların teknik sorumluluklarını üstlenir.</div>
                            <a href="https://forms.gle/8thD7enX33vWLza36" target="_blank" class="btn btn-success team-join-btn">Ekibe Katıl!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team-roles-section py-5" style="background: #f8f9fa;">
    <div class="container" style="padding-bottom: 30px;">
        <div class="text-center mb-5" data-aos="fade-up"  style="padding-top: 30px;">
            <h2 class="fw-bold" style="font-size: 2.3rem;"><b>Ekiplerimizin Görev ve Sorumlulukları</b></h2>
        </div>

        <div class="row g-4" style="padding-top: 30px;">
            <!-- Sosyal Medya Ekibi -->
            <div class="col-md-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                    <h4 class="fw-bold text-success mb-3"><i class="fab fa-instagram me-2" style="padding-right: 5px;"></i>Sosyal Medya ve İletişim Ekibi</h4>
                    <p class="text-muted mb-2">
                        Instagram, Linkedin ve TikTok gibi sosyal mecralara içerik üreterek her kesimden insana ulaşıp iklim ve çevre bilinci yayar.
                    </p>
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li><i class="fa fa-thumb-tack text-success"></i> Aktif bir sosyal medya kullanıcısı olmak ve gündemi sürekli takip etmek.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Haftada en az bir veya iki kez özgün içerik üretmek.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Her göze hitap eden ve karmaşık olmayan tasarımlar yapmak.</li>
                    </ul>
                </div>
            </div>

            <!-- Organizasyon Ekibi -->
            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                    <h4 class="fw-bold text-success mb-3"><i class="fas fa-users me-2" style="padding-right: 5px;"></i>Organizasyon Ekibi</h4>
                    <p class="text-muted mb-2">
                        Alanında uzman kişiler ile iletişim kurup atölyeler organize ederek insanları bilinçlendirmeyi hedefler.
                    </p>
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li><i class="fa fa-thumb-tack text-success"></i> E-posta ve konuk davet maillerini göndermek.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Konuk, konuşmacı veya katılımcılar ile iletişimi sağlamak.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Etkinliklerin tarihini, saatini, yerini belirlemek.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Etkinliklerin temasını, amacını ve hedef kitlesini belirlemek.</li>
                    </ul>
                </div>
            </div>

            <!-- Proje & Kampanya Ekibi -->
            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                    <h4 class="fw-bold text-success mb-3"><i class="fas fa-bullhorn me-2" style="padding-right: 5px;"></i>Proje ve Kampanya Ekibi</h4>
                    <p class="text-muted mb-2">
                        Kampanyalar çıkararak ve imza toplayarak iklim değişikliğine karşı somut adımlar atmak üzerine çalışır.
                    </p>
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li><i class="fa fa-thumb-tack text-success"></i> Proje fikirleri üretmek ve uygulama süreçlerine aktif katılmak.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Toplumsal ve çevresel farkındalık yaratacak kampanyalar tasarlamak.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Diğer ekipler ile kampanyaların tanıtımını ve yürütülmesini sağlamak.</li>
                    </ul>
                </div>
            </div>

            <!-- Teknoloji Ekibi -->
            <div class="col-md-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                    <h4 class="fw-bold text-success mb-3"><i class="fas fa-laptop-code me-2" style="padding-right: 5px;"></i>Teknoloji Ekibi</h4>
                    <p class="text-muted mb-2">
                        Organizasyonumuz bünyesinde yürütülen çalışmaların teknik sorumluluklarını ve işlerini üstlenir.
                    </p>
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li><i class="fa fa-thumb-tack text-success"></i> Genel akıştaki workshopların ve teknik gerektiren işlerin takibini yapmak.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Rutin olarak etkinlik sertifikalarını hazırlamak.</li>
                        <li><i class="fa fa-thumb-tack text-success"></i> Websitemiz için gerekli bazı geliştirmeleri yapmak.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
