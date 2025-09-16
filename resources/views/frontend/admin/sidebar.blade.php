<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('idd-logo.png') }}" alt="Logo">
        <h4>Admin Paneli</h4>
    </div>

    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="menu-item @yield('dashboard-sit')">
            <i class="fas fa-house"></i>
            Dashboard
        </a>

        <a href="{{ route('dashboard.podcasts') }}" class="menu-item @yield('podcasts-sit')">
            <i class="fas fa-microphone"></i>
            Podcastler
        </a>

        <a href="{{ route('dashboard.campaigns') }}" class="menu-item @yield('campaigns-sit')">
            <i class="fas fa-bullhorn"></i>
            Kampanyalar
        </a>

        <a href="{{ route('dashboard.events') }}" class="menu-item @yield('events-sit')">
            <i class="fas fa-calendar-alt"></i>
            Etkinlikler
        </a>

        <a href="{{ route('dashboard.users') }}" class="menu-item @yield('users-sit')">
            <i class="fas fa-users"></i>
            Kullanıcılar
        </a>

        <div class="menu-item @yield('blog-sit')" style="padding: 0;">
            <a href="#" class="menu-item d-flex align-items-center" style="padding: 12px 20px;" onclick="event.preventDefault(); this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block';">
                <i class="fas fa-pencil-square me-2"></i>
                Blog Yazıları
                <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <div class="dropdown-menu-custom" style="display: none; flex-direction: column;">
                <a href="{{ route('dashboard.blog') }}" class="dropdown-item-custom @yield('active-blogs-sit')" style="display: block; padding: 10px 30px;">
                    <i class="fas fa-check-circle me-2"></i> Aktif Yazılar
                </a>
                <a href="{{ route('dashboard.blog.pending') }}" class="dropdown-item-custom @yield('pending-blogs-sit')" style="display: block; padding: 10px 30px;">
                    <i class="fas fa-clock me-2"></i> Beklemedeki Yazılar
                </a>
                <a href="{{ route('dashboard.blog.passive') }}" class="dropdown-item-custom @yield('passive-blogs-sit')" style="display: block; padding: 10px 30px;">
                    <i class="fas fa-minus-circle me-2"></i> Pasif Yazılar
                </a>
            </div>
        </div>

        <a href="{{ route('dashboard.blog.categories') }}" class="menu-item @yield('categories-sit')">
            <i class="fas fa-tags"></i>
            Blog Kategorileri
        </a>

        <a href="{{ route('dashboard.comments') }}" class="menu-item @yield('comments-sit')">
            <i class="fas fa-comments"></i>
            Blog Yorumları
        </a>

        <a href="{{ route('dashboard.messages') }}" class="menu-item @yield('messages-sit')">
            <i class="fas fa-envelope"></i>
            Mesajlar
        </a>
    </div>
</div>
