<section class="logo-section">
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-md-4 col-12 text-center mb-4 mb-md-0" data-aos="fade-right">
                <img src="idd-logo.png" alt="idd-logo" class="img-fluid logo-img">
            </div>

            <!-- Vizyon Metni -->
            <div class="col-md-8 col-12 logo-about" data-aos="fade-left">
                <div class="about-title text-center text-md-start">
                    İKLİM DEĞİŞMEDEN
                    <span class="highlight-wrap">
                        <span class="highlight"><a href="https://linktr.ee/idd.org.tr">DEĞİŞ.</a></span>
                        <span class="about-underline"></span>
                    </span>
                </div>
                <br>
                <div class="about-desc" style="text-align: justify">
                    Vizyonumuz, iklim krizinin yalnızca çevresel değil, aynı zamanda toplumsal, ekonomik ve kültürel bir mesele olduğunu görünür kılmaktır. Bu vizyonla, farklı disiplinlerden uzmanları ortak bir zeminde buluşturarak krizi çok boyutlu biçimde analiz ediyor ve dönüştürücü çözümler üretiyoruz.
                </div>
                <br>
                <div class="about-desc" style="text-align: justify">
                    Değişimi yalnızca istemekle kalmıyor, onu her adımda yaşama dönüştürüyoruz. Eğitimlerden farkındalık kampanyalarına, araştırmalardan teknolojiye uzanan çalışmalarımızla bireyleri iklim eylemine dahil ediyoruz. Bizim için her küçük adım, büyük bir dönüşümün başlangıcıdır — daha yaşanabilir bir dünya için değişimin ta kendisi olmanın yolu da tam buradan geçer.
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Logo boyutunu mobil uyumlu yap */
.logo-img {
    max-height: 280px;
    width: auto;
}

/* Başlık boyutu mobilde küçült */
.about-title {
    font-size: 2rem;
}

@media (max-width: 991px) {
    .about-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 767px) {
    .logo-section {
        padding: 20px 15px;
    }

    .about-title {
        font-size: 1.5rem;
        text-align: center;
    }

    .about-desc {
        font-size: 1rem;
    }

    .logo-img {
        max-height: 200px;
    }
}

/* Küçük ekranlarda metin ve logo alt alta */
@media (max-width: 767px) {
    .logo-about {
        text-align: center;
    }
}
</style>
