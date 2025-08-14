<style>
    :root {
        --idd-green: #2c7933;
    }

    html, body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        font-family: 'Inter', Arial, Helvetica, sans-serif;
        padding-top: 56px;
    }

    p, .about-desc, .slider-desc, .logo-section .about-subtitle, .stat-card, .lead, .footer, .auth-buttons, .btn, .navbar, .dropdown-item {
        font-family: 'Inter', Arial, Helvetica, sans-serif !important;
    }

    h1, h2, h3, h4, h5, h6, .hero-title, .about-title, .slider-title {
        font-family: 'Montserrat', Arial, Helvetica, sans-serif !important;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    /* Navigation Styles */
    .navbar {
        background-color: #212529 !important;
        padding-top: 0.6rem;
        padding-bottom: 0.6rem;
        min-height: 56px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        width: 100%;
        transition: none;
    }

    .navbar .nav-link {
        font-size: 1.08rem;
        padding-left: 1.2rem;
        padding-right: 1.2rem;
    }

    .navbar .navbar-brand {
        font-size: 1.18rem;
    }

    .navbar .navbar-brand img {
        height: 56px;
        max-height: 64px;
        width: auto;
        transition: height 0.3s;
    }

    .navbar .btn, .auth-buttons .btn {
        font-size: 1.08rem;
        padding: 0.6rem 1.3rem;
    }

    .navbar .lang-switcher {
        background: rgba(255,255,255,0.1);
        border-radius: 8px;
        padding: 4px;
        display: inline-flex;
        position: relative;
        cursor: pointer;
        margin-left: 1rem;
        width: 120px;
        height: 44px;
        user-select: none;
    }

    .navbar .lang-option {
        position: absolute;
        width: 58px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 600;
        color: rgba(255,255,255,0.7);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1;
    }

    .navbar .lang-option[data-lang="tr"] {
        left: 4px;
    }

    .navbar .lang-option[data-lang="en"] {
        right: 4px;
    }

    .navbar .lang-switcher::before {
        content: '';
        position: absolute;
        width: 58px;
        height: 36px;
        background: #2c7933;
        border-radius: 6px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        left: 4px;
    }

    .navbar .lang-switcher.en::before {
        left: calc(100% - 62px);
    }

    .navbar .lang-option.active {
        color: white;
    }

    @media (max-width: 991px) {
        .navbar .nav-link {
            font-size: 0.98rem;
            padding-left: 0.8rem;
            padding-right: 0.8rem;
        }
        .navbar .btn, .auth-buttons .btn {
            font-size: 0.98rem;
            padding: 0.5rem 1rem;
        }
        .navbar .navbar-brand img {
            height: 44px;
            max-height: 48px;
        }
        .navbar .navbar-collapse {
            text-align: left;
        }
        .navbar .lang-switcher-mobile {
            display: flex;
            justify-content: center;
            margin: 0.5rem 0;
        }
        .navbar .lang-switcher {
            margin-left: 0;
            width: 100px;
            height: 40px;
        }
        .navbar .lang-option {
            width: 48px;
            height: 32px;
            font-size: 1rem;
        }
        .navbar .lang-switcher::before {
            width: 48px;
            height: 32px;
        }
        .navbar .lang-switcher.en::before {
            left: calc(100% - 52px);
        }
    }

    /* Hero Section Styles */
    .hero-section {
        position: relative;
        min-height: 80vh;
        height: 80vh;
        width: 100vw;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        overflow: hidden;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 !important;
    }

    .hero-content {
        text-align: center;
        position: relative;
        z-index: 2;
        padding: 2rem;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #333;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-cta {
        display: inline-flex;
        align-items: center;
        padding: 0.8rem 2rem;
        background-color: var(--idd-green);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .hero-cta:hover {
        background-color: #245c2a;
        color: white;
        transform: translateY(-3px);
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .hero-shape {
        position: absolute;
        border-radius: 50%;
    }

    .shape-1 {
        width: 150px;
        height: 150px;
        background-color: rgba(44, 121, 51, 0.1);
        top: 10%;
        left: 10%;
    }

    .shape-2 {
        width: 100px;
        height: 100px;
        background-color: rgba(44, 121, 51, 0.15);
        top: 60%;
        right: 15%;
    }

    .shape-3 {
        width: 80px;
        height: 80px;
        background-color: rgba(44, 121, 51, 0.1);
        bottom: 10%;
        left: 20%;
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
        }

        .shape-2 {
            width: 70px;
            height: 70px;
        }

        .shape-3 {
            width: 50px;
            height: 50px;
        }

        .hero-section {
            min-height: 50vh;
            height: 50vh;
        }
    }

    .stat-card {
        transition: transform 0.3s;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .stat-card:hover {
        transform: translateY(-10px);
    }
    .impact-section {
        background-color: #f8f9fa;
        padding: 80px 0;
    }
    .cta-section {
        background-color: var(--idd-green);
        color: white;
        padding: 60px 0;
    }
    .logo-section {
        padding: 40px 0;
        background-color: #f8f9fa;
    }
    .logo-section .logo-about {
        text-align: left;
        padding-left: 2.5rem;
    }
    .logo-section .about-title {
        font-size: 2.8rem;
        font-weight: 700;
        letter-spacing: -1px;
        line-height: 1.1;
        color: #222;
        margin-bottom: 0.5rem;
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: baseline;
        gap: 0.3em;
    }
    .logo-section .about-title .highlight-wrap {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }
    .logo-section .about-title .highlight {
        font-weight: 900;
        color: #222;
        display: block;
        line-height: 1.1;
    }
    .logo-section .about-title .about-underline {
        width: 100%;
        height: 6px;
        background: #2c7933;
        border-radius: 3px;
        margin: 0.18rem 0 0 0;
        display: block;
    }
    .logo-section .about-subtitle {
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: #888;
        font-weight: 600;
        margin-bottom: 1.2rem;
    }
    .logo-section .about-underline {
        display: none;
    }
    .logo-section .about-desc {
        font-size: 1.1rem;
        color: #444;
        margin-bottom: 0;
    }
    @media (max-width: 991px) {
        .logo-section .about-title {
            justify-content: center;
        }
        .logo-section .logo-about {
            text-align: center;
            margin-top: 2rem;
            padding-left: 0;
        }
        .logo-section .about-underline {
            margin-left: auto;
            margin-right: auto;
        }
    }
    .stats-section {
        padding: 60px 0;
    }
    .stats-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--idd-green);
    }
    .dropdown-menu {
        background-color: rgba(33, 37, 41, 0.95);
        display: none;
    }
    .dropdown:hover .dropdown-menu {
        display: block;
    }
    .dropdown-item {
        color: white;
    }
    .dropdown-item:hover {
        background-color: var(--idd-green);
        color: white;
    }
    .auth-buttons .btn {
        margin-left: 10px;
    }
    .btn-success {
        background-color: var(--idd-green);
        border-color: var(--idd-green);
    }
    .btn-success:hover {
        background-color: #245c2a;
        border-color: #245c2a;
    }
    .btn-outline-success {
        color: var(--idd-green);
        border-color: var(--idd-green);
    }
    .btn-outline-success:hover {
        background-color: var(--idd-green);
        border-color: var(--idd-green);
    }
    .scroll-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background-color: var(--idd-green);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
    }
    .scroll-to-top.show {
        opacity: 1;
        visibility: visible;
    }
    .scroll-to-top:hover {
        background-color: #245c2a;
        color: white;
        transform: translateY(-3px);
    }
    .logo-section .about-title .highlight a {
        color: inherit;
        text-decoration: none;
        cursor: default;
        font: inherit;
    }
    .logo-section .about-title .highlight a:hover,
    .logo-section .about-title .highlight a:focus {
        color: inherit;
        text-decoration: none;
        cursor: default;
    }
    @media (max-width: 767px) {
        #main-slider {
            min-height: 80vh !important;
            height: 80vh !important;
        }
        .slider-content {
            max-width: 95vw !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
            align-items: center !important;
            text-align: center !important;
        }
        .slider-title {
            font-size: 1.5rem !important;
            margin-bottom: 0.7rem !important;
            text-align: center !important;
        }
        .slider-desc {
            font-size: 1rem !important;
            max-width: 95vw !important;
            margin-bottom: 1.2rem !important;
            text-align: center !important;
        }
        .slider-btn {
            font-size: 1rem !important;
            padding: 0.7rem 1.3rem !important;
            margin-bottom: 1.2rem !important;
        }
        .slider-arrow {
            width: 38px !important;
            height: 38px !important;
            font-size: 1.5rem !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
        }
        .slider-arrow-left {
            left: 10px !important;
        }
        .slider-arrow-right {
            right: 10px !important;
        }
    }
    .team-card {
        width: 100%;
        max-width: 340px;
        height: 320px;
        perspective: 1200px;
        margin-bottom: 24px;
    }
    .team-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.7s cubic-bezier(0.4,0,0.2,1);
        transform-style: preserve-3d;
        cursor: pointer;
    }
    .team-card.flipped .team-card-inner {
        transform: rotateY(180deg);
    }
    .team-card-front, .team-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(44,121,51,0.08), 0 1.5px 6px rgba(44,121,51,0.06);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 24px 18px;
        transition: box-shadow 0.3s;
    }
    .team-card-front:hover, .team-card-back:hover {
        box-shadow: 0 8px 32px rgba(44,121,51,0.13), 0 2.5px 10px rgba(44,121,51,0.09);
    }
    .team-card-front {
        z-index: 2;
    }
    .team-card-back {
        transform: rotateY(180deg);
        z-index: 3;
    }
    .team-title {
        font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: #2c7933;
        margin-bottom: 0;
        letter-spacing: -0.5px;
        text-align: center;
    }
    .team-icon {
        color: #2c7933;
        margin-bottom: 0.5rem;
    }
    .team-desc {
        font-family: 'Inter', Arial, Helvetica, sans-serif;
        font-size: 1.05rem;
        color: #333;
        text-align: center;
    }
    .team-join-btn {
        font-family: 'Inter', Arial, Helvetica, sans-serif;
        font-weight: 700;
        font-size: 1.08rem;
        padding: 0.7rem 1.7rem;
        border-radius: 8px;
        margin-top: 0.5rem;
    }
    @media (max-width: 991px) {
        .team-card { margin-bottom: 32px; }
    }
    @media (max-width: 767px) {
        #teams-section { padding: 40px 0; }
        .team-card { max-width: 95vw; height: 300px; }
        .team-card-inner { min-height: 300px; }
    }
    footer .row {
        gap: 48px 0;
    }
    @media (min-width: 768px) {
        footer .col-md-4:not(:last-child) {
            padding-right: 48px;
        }
        footer .col-md-4:not(:first-child) {
            padding-left: 48px;
        }
    }
    @media (max-width: 767px) {
        footer .row {
            gap: 32px 0;
        }
        footer .col-md-7,
        footer .col-md-5 {
            text-align: center;
        }
        footer .contact-info p {
            justify-content: center;
            display: flex;
            align-items: center;
        }
        footer .social-links {
            justify-content: center;
            display: flex;
            gap: 1rem;
        }
        footer img {
            margin: 0 auto;
        }
        footer .contact-social-wrapper {
            gap: 2rem;
            padding-left: 0 !important;
        }
    }
    #main-slider {
        min-height: 95vh !important;
        height: 95vh !important;
    }
    @media (max-width: 767px) {
        #main-slider {
            min-height: 80vh !important;
            height: 80vh !important;
        }
    }
    footer .contact-info p {
        display: flex;
        align-items: center;
    }
    footer .social-links a:hover {
        color: var(--idd-green) !important;
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
</style>
