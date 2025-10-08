<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    @include('frontend.admin.styles')
</head>
<body>
    <!-- Profile Details Sidebar -->
    <div class="sidebar" id="sidebar">
         <div class="sidebar-header">
            <img src="{{ asset('idd-logo.png') }}" alt="Logo">
            <h4>Profilim</h4>
        </div>

        <style>
            .sidebar-header {
                text-align: center;
                padding: 20px;
            }

            .profile-icon i {
                font-size: 80px;
                color: light-gray;
                margin-bottom: 10px;
            }

            .sidebar-header h4 {
                margin: 0;
                color: white;
                font-weight: 600;
            }
        </style>

        <div class="sidebar-menu">
            <!-- Profil -->
            <a href="{{ route('blog.profile') }}" class="menu-item @yield('account-details-sit')">
                <i class="fas fa-user"></i>
                Profil Bilgileri
            </a>

            <!-- Hesap Ayarları -->
            <a href="{{ route('blog.profile.account') }}" class="menu-item @yield('account-settings-sit')">
                <i class="fas fa-cog"></i>
                Hesap Ayarları
            </a>

            <!-- Beğenilen Yazılar -->
            <a href="{{ route('blog.profile.likes') }}" class="menu-item @yield('likes-sit')">
                <i class="fas fa-heart"></i>
                Beğenilen Yazılar
            </a>

            <!-- Yapılan Yorumlar -->
            <a href="{{ route('blog.profile.comments') }}" class="menu-item @yield('my-comments-sit')">
                <i class="fas fa-comments"></i>
                Yapılan Yorumlar
            </a>

            <!-- Yazılarım (Sadece Yazarlar için gösterilecek) -->
            @role('writer|admin')
                <a href="{{ route('blog.profile.articles') }}" class="menu-item @yield('my-articles-sit')">
                    <i class="fas fa-file-alt"></i>
                    Yazılarım
                </a>
            @endrole
        </div>
    </div>

    @include('frontend.admin.topbar')

    <!-- Main Content Area -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
