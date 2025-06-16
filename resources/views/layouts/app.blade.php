<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EcoTrack.ID')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CSS untuk Peta (jika pakai Leaflet) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    {{-- Font Awesome untuk Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --primary-green: #10b981;
        --dark-green: #047857;
        --light-green: #d1fae5;
        --accent-green: #34d399;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --bg-light: #f8fafc;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
    }

    * {
        font-family: 'Inter', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
        min-height: 100vh;
        color: var(--text-dark);
    }

    /* Enhanced Modern Navbar */
    .navbar-modern {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 8px 32px rgba(16, 185, 129, 0.1);
        border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        padding: 0.75rem 0;
        transition: all 0.3s ease;
    }

    .navbar-modern.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 0.5rem 0;
    }

    .navbar-brand-modern {
        font-size: 1.75rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .navbar-brand-modern::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        transition: width 0.3s ease;
    }

    .navbar-brand-modern:hover::before {
        width: 100%;
    }

    .navbar-brand-modern:hover {
        transform: scale(1.02);
    }

    .brand-emoji {
        font-size: 2rem;
        filter: drop-shadow(0 2px 4px rgba(16, 185, 129, 0.3));
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-3px);
        }
    }

    .slogan-modern {
        font-size: 0.85rem;
        color: var(--text-light);
        font-weight: 400;
        font-style: italic;
        margin-left: 1.5rem;
        opacity: 0.8;
        position: relative;
    }

    .slogan-modern::before {
        content: '|';
        position: absolute;
        left: -0.75rem;
        color: var(--primary-green);
        font-weight: 300;
    }

    /* Enhanced Navigation Links */
    .nav-link-modern {
        color: var(--text-dark) !important;
        font-weight: 500;
        padding: 0.75rem 1.25rem !important;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        margin: 0 0.25rem;
        overflow: hidden;
    }

    .nav-link-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        transition: left 0.3s ease;
        z-index: -1;
        opacity: 0.1;
    }

    .nav-link-modern:hover::before {
        left: 0;
    }

    .nav-link-modern:hover {
        color: var(--dark-green) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .nav-link-modern.active {
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        color: white !important;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .nav-link-modern.active::before {
        display: none;
    }

    .nav-link-modern i {
        margin-right: 0.5rem;
        transition: transform 0.3s ease;
    }

    .nav-link-modern:hover i {
        transform: scale(1.1);
    }

    /* Enhanced Dropdown */
    .dropdown-menu-modern {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(16, 185, 129, 0.1);
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        padding: 0.75rem;
        margin-top: 0.75rem;
        min-width: 220px;
        animation: dropdownSlide 0.3s ease;
    }

    @keyframes dropdownSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item-modern {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        color: var(--text-dark);
        position: relative;
        overflow: hidden;
    }

    .dropdown-item-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--light-green), rgba(16, 185, 129, 0.1));
        transition: left 0.3s ease;
        z-index: -1;
    }

    .dropdown-item-modern:hover::before {
        left: 0;
    }

    .dropdown-item-modern:hover {
        color: var(--dark-green);
        transform: translateX(8px);
    }

    .dropdown-item-modern i {
        width: 20px;
        text-align: center;
        margin-right: 0.75rem;
        transition: transform 0.3s ease;
    }

    .dropdown-item-modern:hover i {
        transform: scale(1.1);
    }

    /* Enhanced User Avatar */
    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
        margin-right: 0.75rem;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        transition: all 0.3s ease;
        position: relative;
    }

    .user-avatar::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        border-radius: 50%;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .dropdown-toggle:hover .user-avatar::before {
        opacity: 1;
    }

    .dropdown-toggle:hover .user-avatar {
        transform: scale(1.05);
    }

    .user-name {
        font-weight: 600;
        color: var(--text-dark);
        transition: color 0.3s ease;
    }

    .dropdown-toggle:hover .user-name {
        color: var(--primary-green);
    }

    /* Enhanced Mobile Toggle */
    .navbar-toggler-modern {
        border: 2px solid var(--primary-green);
        padding: 0.5rem;
        border-radius: 12px;
        background: transparent;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .navbar-toggler-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--primary-green);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .navbar-toggler-modern:hover::before {
        left: 0;
    }

    .navbar-toggler-modern:focus {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }

    .navbar-toggler-modern:hover {
        border-color: var(--dark-green);
    }

    .navbar-toggler-icon-modern {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%2310b981' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.5' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        transition: all 0.3s ease;
    }

    .navbar-toggler-modern:hover .navbar-toggler-icon-modern {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.5' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Notification Badge */
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Main Content */
    .main-content {
        min-height: calc(100vh - 200px);
        padding-top: 2rem;
    }

    /* Modern Footer */
    .footer-modern {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        color: #ffffff;
        padding: 3rem 0 2rem;
        margin-top: 4rem;
        position: relative;
        overflow: hidden;
    }

    .footer-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--primary-green), transparent);
    }

    .footer-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .footer-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--accent-green);
        margin-bottom: 0.5rem;
    }

    .footer-text {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin: 0;
    }

    .footer-links {
        display: flex;
        gap: 2rem;
        margin: 1rem 0;
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .footer-link:hover {
        color: var(--accent-green);
        transform: translateY(-2px);
    }

    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: var(--primary-green);
        color: #ffffff;
        transform: translateY(-3px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .slogan-modern {
            display: none !important;
        }

        .navbar-brand-modern {
            font-size: 1.5rem;
        }

        .brand-emoji {
            font-size: 1.75rem;
        }

        .footer-links {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .social-links {
            justify-content: center;
        }

        .nav-link-modern {
            margin: 0.25rem 0;
        }
    }

    /* Loading Animation */
    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }

    .loader-content {
        text-align: center;
        color: white;
    }

    .loader-spinner {
        width: 50px;
        height: 50px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top: 3px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Scroll to Top Button */
    .scroll-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 50px;
        height: 50px;
        background: var(--primary-green);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        z-index: 1000;
    }

    .scroll-top.show {
        opacity: 1;
        visibility: visible;
    }

    .scroll-top:hover {
        background: var(--dark-green);
        transform: translateY(-3px);
    }
    </style>
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-spinner"></div>
            <h5>🌱 EcoTrack.ID</h5>
            <p>Memuat platform hijau...</p>
        </div>
    </div>

    <!-- Enhanced Modern Navbar -->
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand-modern" href="{{ route('dashboard') }}">
                <span class="brand-emoji">🌱</span>
                <span>EcoTrack.ID</span>
            </a>
            <span class="slogan-modern d-none d-lg-block">"Jejak Aksi Hijaumu, Dampak untuk Bumi."</span>

            <button class="navbar-toggler navbar-toggler-modern" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon navbar-toggler-icon-modern"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="{{ route('reports.index') }}">
                            <i class="fas fa-map-marked-alt"></i>Peta Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern position-relative" href="{{ route('challenges.index') }}">
                            <i class="fas fa-trophy"></i>Tantangan
                            <span class="notification-badge">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="{{ route('green-map.index') }}">
                            <i class="fas fa-leaf"></i>Peta Hijau
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-modern dropdown-toggle d-flex align-items-center" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-end">
                            <li>
                                <a class="dropdown-item dropdown-item-modern" href="#">
                                    <i class="fas fa-user"></i>Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-modern" href="#">
                                    <i class="fas fa-chart-line"></i>Statistik
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-modern" href="#">
                                    <i class="fas fa-cog"></i>Pengaturan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-modern" href="#">
                                    <i class="fas fa-question-circle"></i>Bantuan
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-modern text-danger">
                                        <i class="fas fa-sign-out-alt"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i>Register
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content" style="margin-top: 85px;">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Modern Footer -->
    <footer class="footer-modern">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">🌱 EcoTrack.ID</div>
                <p class="footer-text">Platform kolaboratif untuk lingkungan yang lebih baik</p>

                <div class="footer-links">
                    <a href="#" class="footer-link">Tentang Kami</a>
                    <a href="#" class="footer-link">Kebijakan Privasi</a>
                    <a href="#" class="footer-link">Syarat & Ketentuan</a>
                    <a href="#" class="footer-link">Kontak</a>
                </div>

                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>

                <p class="footer-text mt-3">© {{ date('Y') }} EcoTrack.ID. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
    // Page Loader
    window.addEventListener('load', function() {
        const loader = document.getElementById('pageLoader');
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }, 1000);
    });

    // Enhanced Navbar Scroll Effect
    const navbar = document.getElementById('mainNavbar');
    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        // Auto-hide navbar on scroll down, show on scroll up
        if (scrollTop > lastScrollTop && scrollTop > 100) {
            navbar.style.transform = 'translateY(-100%)';
        } else {
            navbar.style.transform = 'translateY(0)';
        }
        lastScrollTop = scrollTop;
    });

    // Scroll to Top Button
    const scrollTopBtn = document.getElementById('scrollTop');

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollTopBtn.classList.add('show');
        } else {
            scrollTopBtn.classList.remove('show');
        }
    });

    scrollTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Active Navigation Link
    const currentLocation = location.pathname;
    const menuItems = document.querySelectorAll('.nav-link-modern');

    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentLocation) {
            item.classList.add('active');
        }
    });

    // Enhanced Dropdown Animation
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('show.bs.dropdown', function() {
            const menu = this.nextElementSibling;
            menu.style.animation = 'dropdownSlide 0.3s ease';
        });
    });

    // Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Mobile Menu Auto Close
    const navLinks = document.querySelectorAll('.nav-link-modern');
    const navbarCollapse = document.getElementById('navbarNav');

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                    toggle: false
                });
                bsCollapse.hide();
            }
        });
    });
    </script>

    @stack('scripts')
</body>

</html>