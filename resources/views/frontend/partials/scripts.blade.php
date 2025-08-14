<script>
    document.addEventListener('DOMContentLoaded', function() {
        // AOS Initialize
        AOS.init({
            duration: 800,
            offset: 100,
            once: true,
            easing: 'ease-out-cubic'
        });

        // Scroll to Top Button
        const scrollToTopButton = document.querySelector('.scroll-to-top');
        function checkScroll() {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 300) {
                scrollToTopButton.classList.add('show');
            } else {
                scrollToTopButton.classList.remove('show');
            }
        }
        window.addEventListener('scroll', checkScroll);
        scrollToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>

<script>
// Slider veri seti
const sliderData = [
    {
        image: 'https://plus.unsplash.com/premium_photo-1697644695029-3f78910dbc39?q=80&w=1172&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        title: 'Sürdürülebilir Moda',
        desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a vestibulum ante. Fusce vitae commodo lectus. Sed semper varius molestie. Donec iaculis erat at arcu lobortis, egestas molestie tortor tristique.',
        btn: { text: 'Daha Fazla!', link: '#' }
    },
    {
        image: 'https://images.unsplash.com/photo-1476820865390-c52aeebb9891?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        title: 'En Yakın Etkinlikler',
        desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a vestibulum ante. Fusce vitae commodo lectus. Sed semper varius molestie. Donec iaculis erat at arcu lobortis, egestas molestie tortor tristique.',
        btn: { text: 'Daha Fazla Bilgi', link: '#' }
    },
    {
        image: 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&w=1200&q=80',
        title: 'Bizle Beraber Bu Yolda Yer Al!',
        desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a vestibulum ante. Fusce vitae commodo lectus. Sed semper varius molestie. Donec iaculis erat at arcu lobortis, egestas molestie tortor tristique.',
        btn: { text: 'Gönüllü Ol!', link: '#' }
    }
];

let sliderIndex = 0;
let sliderInterval = null;
const sliderDuration = 5000;

function showSlide(idx) {
    const data = sliderData[idx];
    document.querySelector('.slider-title').textContent = data.title;
    document.querySelector('.slider-desc').textContent = data.desc;
    const btn = document.querySelector('.slider-btn');
    btn.textContent = data.btn.text;
    btn.setAttribute('href', data.btn.link);
    document.querySelector('.slider-bg').style.backgroundImage = `url('${data.image}')`;
}

function nextSlide() {
    sliderIndex = (sliderIndex + 1) % sliderData.length;
    showSlide(sliderIndex);
}
function prevSlide() {
    sliderIndex = (sliderIndex - 1 + sliderData.length) % sliderData.length;
    showSlide(sliderIndex);
}
function startSlider() {
    if (sliderInterval) clearInterval(sliderInterval);
    sliderInterval = setInterval(nextSlide, sliderDuration);
}

document.addEventListener('DOMContentLoaded', function() {
    // Başlangıç slaytı
    showSlide(sliderIndex);
    startSlider();
    document.querySelector('.slider-arrow-left').addEventListener('click', function() {
        prevSlide();
        startSlider();
    });
    document.querySelector('.slider-arrow-right').addEventListener('click', function() {
        nextSlide();
        startSlider();
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.team-card').forEach(function(card) {
        card.addEventListener('click', function() {
        // Diğer kartların hepsinin flipped class'ını kaldır
        document.querySelectorAll('.team-card').forEach(function(otherCard) {
            if (otherCard !== card) {
            otherCard.classList.remove('flipped');
            }
        });
        // Tıklanan kartı çevir
        card.classList.toggle('flipped');
        });
    });
    });
</script>

<script>
    document.querySelectorAll('.lang-switcher').forEach(switcher => {
        switcher.addEventListener('click', function() {
            const isCurrentlyTR = !this.classList.contains('en');

            // Tüm switcherleri güncelle
            document.querySelectorAll('.lang-switcher').forEach(sw => {
                if (isCurrentlyTR) {
                    sw.classList.add('en');
                } else {
                    sw.classList.remove('en');
                }
            });
        });
    });
</script>
