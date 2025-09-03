<div class="main-content">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-dark sidebar-toggle me-3" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <i class="@yield('topbar-icon')" style="padding-right: 20px"></i>
            <h5 class="mb-0" style="padding-bottom: 2px">@yield('topbar-header')</h5>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('blog') }}" class="btn btn-outline-danger">
                <i class="fas fa-sign-out-alt"></i> Blog Anasayfasına Dön
            </a>
        </div>
    </div>
