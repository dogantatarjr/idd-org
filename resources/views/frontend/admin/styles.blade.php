<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: #f8f9fa;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 280px;
        background: linear-gradient(135deg, #212529 0%, #343a40 100%);
        color: white;
        z-index: 1000;
        transition: all 0.3s ease;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        text-align: center;
    }

    .sidebar-header img {
        height: 120px;
        margin-bottom: 10px;
    }

    .sidebar-header h4 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .sidebar-menu {
        padding: 20px 0;
        height: calc(100vh - 140px);
        overflow-y: auto;
    }

    .menu-item {
        display: block;
        padding: 12px 20px;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
    }

    .menu-item:hover, .menu-item.active {
        background-color: rgba(255,255,255,0.1);
        color: white;
        padding-left: 30px;
    }

    .menu-item i {
        width: 20px;
        margin-right: 10px;
    }

    .dropdown-menu-custom {
        border: none;
        margin-left: 20px;
        margin-top: 5px;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .dropdown-item-custom {
        color: rgba(255,255,255,0.7);
        padding: 8px 20px;
        text-decoration: none;
    }

    .dropdown-item-custom:hover {
        background-color: rgba(255,255,255,0.1);
        color: white;
    }

    .main-content {
        margin-left: 280px;
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    .top-navbar {
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 15px 30px;
        margin-bottom: 30px;
    }

    .content-area {
        padding: 0 30px 30px;
    }

    .dashboard-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 30px;
        margin-bottom: 30px;
        border: none;
    }

    .stat-card {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        text-align: center;
        padding: 30px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .stat-card.success {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    }

    .stat-card.warning {
        background: linear-gradient(135deg, #ffc107 0%, #d39e00 100%);
    }

    .stat-card.danger {
        background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .sidebar-toggle {
        display: none;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar-toggle {
            display: inline-block;
        }

        .content-area {
            padding: 0 15px 15px;
        }

        .top-navbar {
            padding: 15px;
        }
    }

    .user-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        border-top: 1px solid rgba(255,255,255,0.1);
        background: rgba(0,0,0,0.2);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #007bff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-weight: bold;
    }
</style>
