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

        <a href="{{ route('dashboard.blog') }}" class="menu-item @yield('blog-sit')">
            <i class="fas fa-blog"></i>
            Blog Yönetimi
        </a>

        <a href="{{ route('dashboard.users') }}" class="menu-item @yield('users-sit')">
            <i class="fas fa-users"></i>
            Kullanıcılar
        </a>

        <a href="{{ route('dashboard.messages') }}" class="menu-item @yield('messages-sit')">
            <i class="fas fa-envelope"></i>
            Mesajlar
        </a>

        <a href="{{ route('dashboard.settings') }}" class="menu-item @yield('settings-sit')">
            <i class="fas fa-cog"></i>
            Ayarlar
        </a>
    </div>
</div>
