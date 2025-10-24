<style>
    #main-slider {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    .slides-wrapper {
        display: flex;
        height: 100%;
        transition: transform 0.8s ease;
    }

    .slide {
        min-width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center 40%; /* Fotoğrafı biraz yukarı kaydır */
        position: relative;
        display: flex;
        align-items: center;
    }

    /* Her slide için özel background-position ayarı yapabilirsiniz */
    .slide:nth-child(1) {
        background-position: center 35%;
    }

    .slide:nth-child(2) {
        background-position: center 45%;
    }

    .slider-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.45);
        z-index: 1;
    }

    .slider-content {
        position: relative;
        z-index: 2;
        margin-left: 240px;
        margin-top: 60px; /* İçeriği aşağı kaydır */
        max-width: 900px;
        color: white;
    }

    .slider-content h2 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 12px rgba(0, 0, 0, 0.5);
        line-height: 1.2;
    }

    .slider-content p {
        font-size: 1.25rem;
        margin-bottom: 2.5rem;
        max-width: 700px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        line-height: 1.6;
    }

    .slider-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        cursor: pointer;
        font-size: 2.5rem;
        color: white;
        user-select: none;
        background: rgba(0, 0, 0, 0.3);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .slider-arrow:hover {
        background: rgba(44, 121, 51, 0.8);
        transform: translateY(-50%) scale(1.1);
    }

    .slider-arrow-left {
        left: 30px;
    }

    .slider-arrow-right {
        right: 30px;
    }

    /* Tablet */
    @media (max-width: 991px) {
        .slider-content {
            margin-left: 100px;
            margin-top: 40px;
            max-width: 700px;
        }

        .slider-content h2 {
            font-size: 2.3rem;
        }

        .slider-content p {
            font-size: 1.15rem;
        }
    }

    /* Mobile */
    @media (max-width: 767px) {
        .slider-content {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 20px;
            max-width: calc(100% - 40px);
            text-align: center;
        }

        .slider-content h2 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .slider-content p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .slider-arrow {
            width: 40px;
            height: 40px;
            font-size: 1.8rem;
        }

        .slider-arrow-left {
            left: 15px;
        }

        .slider-arrow-right {
            right: 15px;
        }
    }
</style>

<section id="main-slider">
    <div class="slides-wrapper">
        @foreach($carousels as $carousel)
            <div class="slide" style="background-image: url('{{ asset('storage/' . $carousel->image) }}');">
                <div class="slider-overlay"></div>
                <div class="slider-content">
                    <h2>{{ $carousel->title }}</h2>
                    <p>{{ $carousel->content }}</p>
                    @if($carousel->link)
                        <a href="{{ $carousel->link }}" target="_blank" class="btn btn-success btn-lg">
                            <i class="fas fa-external-link" style="margin-right: 8px;"></i>Detayları Gör
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="slider-arrow slider-arrow-left">&#10094;</div>
    <div class="slider-arrow slider-arrow-right">&#10095;</div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slidesWrapper = document.querySelector('.slides-wrapper');
        const slides = document.querySelectorAll('.slide');
        const leftArrow = document.querySelector('.slider-arrow-left');
        const rightArrow = document.querySelector('.slider-arrow-right');
        let currentIndex = 0;
        const total = slides.length;

        if (total === 0) return;

        function showSlide(index) {
            slidesWrapper.style.transform = `translateX(-${index * 100}%)`;
            currentIndex = index;
        }

        rightArrow.addEventListener('click', () => {
            showSlide((currentIndex + 1) % total);
        });

        leftArrow.addEventListener('click', () => {
            showSlide((currentIndex - 1 + total) % total);
        });
    });
</script>
