<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-bottom: none; box-shadow: none;">
    <div class="container">
        <a class="navbar-brand" href="/idd-org/public">
            <img src="idd_logo.png" alt="idd-logo" height="48" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link @yield('home-sit')" href="/idd-org/public">Ana Sayfa</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link @yield('projects-sit') dropdown-toggle" href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Projelerimiz
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/idd-org/public/book">Kitap</a></li>
                        <li><a class="dropdown-item" href="/idd-org/public/podcast">Podcast</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('campaigns-sit')" href="/idd-org/public/campaings">Kampanyalarımız</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @yield('about-sit')" href="/idd-org/public/about">Hakkımızda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @yield('contact-sit')" href="/idd-org/public/contact">İletişim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('blog-sit')" href="/idd-org/public/blog">Blog</a>
                </li>
            </ul>
            <div class="d-none d-lg-flex align-items-center">
                <div class="lang-switcher">
                    <span class="lang-option" data-lang="tr">TR</span>
                    <span class="lang-option" data-lang="en">EN</span>
                </div>
            </div>
            <div class="d-lg-none lang-switcher-mobile">
                <div class="lang-switcher">
                    <span class="lang-option" data-lang="tr">TR</span>
                    <span class="lang-option" data-lang="en">EN</span>
                </div>
            </div>
        </div>
    </div>
</nav>
