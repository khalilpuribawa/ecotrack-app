@extends('layouts.app')

@section('title', 'EcoTrack.ID - Track Your Green Action, Impact the Earth')

@section('content')
<style>
/* Reset all margins and paddings */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Override any parent container constraints */
.main-content {
    margin: 0 !important;
    padding: 0 !important;
    width: 100vw !important;
    max-width: none !important;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw !important;
    margin-right: -50vw !important;
}

/* Clean and Simple Styles */
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    line-height: 1.6;
    overflow-x: hidden;
}

/* Hero Section with Dynamic Nature Slideshow */
.hero-section {
    position: relative;
    min-height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    overflow: hidden;
    margin: 0;
    padding: 130px 0 80px 0;
    margin-top: 0;
    background-color: #064e3b;
}

/* Background Slider Container */
.hero-slider {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    overflow: hidden;
}

/* Individual Slide with Ken Burns Effect */
.hero-slide {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    opacity: 0;
    transform: scale(1.08);
    transition: opacity 1.6s cubic-bezier(0.4, 0, 0.2, 1), transform 9s cubic-bezier(0.25, 1, 0.5, 1);
    pointer-events: none;
    will-change: opacity, transform;
}

.hero-slide.active {
    opacity: 1;
    transform: scale(1);
    z-index: 1;
}

/* Clear & Dynamic Overlay: keeps text 100% readable while showing photos vividly */
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(4, 30, 20, 0.75) 0%,
        rgba(5, 45, 30, 0.55) 50%,
        rgba(3, 25, 16, 0.35) 100%
    );
    z-index: 2;
    pointer-events: none;
}

/* Subtle bottom gradient to blend into following section */
.hero-vignette {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 65%, rgba(4, 30, 20, 0.6) 100%);
    z-index: 2;
    pointer-events: none;
}

/* High contrast typography over photo backgrounds */
.hero-section h1,
.hero-section .fs-4,
.hero-section .fs-5 {
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6), 0 1px 3px rgba(0, 0, 0, 0.8);
}

.hero-section .badge-clean {
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    background: rgba(0, 0, 0, 0.35);
    border: 1px solid rgba(255, 255, 255, 0.35);
    backdrop-filter: blur(8px);
}

.hero-section .stats-card-clean {
    background: rgba(4, 30, 20, 0.6) !important;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35) !important;
}

.hero-section .stats-item {
    background: rgba(255, 255, 255, 0.12) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18) !important;
}

.hero-section .stats-item:hover {
    background: rgba(255, 255, 255, 0.22) !important;
    transform: scale(1.05);
}

/* Dynamic Scene Badge */
.badge-nature-scene {
    background: rgba(16, 185, 129, 0.3);
    color: #a7f3d0;
    border: 1px solid rgba(167, 243, 208, 0.45);
    border-radius: 50px;
    padding: 8px 18px;
    font-weight: 600;
    font-size: 13.5px;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: opacity 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

/* Hero Indicators / Pill Navigation at Bottom */
.hero-indicators-container {
    position: absolute;
    bottom: 24px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    z-index: 4;
    pointer-events: none;
}

.hero-indicators {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 10px;
    background: rgba(3, 30, 22, 0.65);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    pointer-events: auto;
    max-width: 94vw;
    overflow-x: auto;
    scrollbar-width: none;
}
.hero-indicators::-webkit-scrollbar {
    display: none;
}

.hero-indicator {
    position: relative;
    background: transparent;
    border: 1px solid transparent;
    color: rgba(255, 255, 255, 0.8);
    font-size: 13px;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 30px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    overflow: hidden;
    white-space: nowrap;
}

.hero-indicator:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.15);
}

.hero-indicator.active {
    color: #ffffff;
    background: rgba(16, 185, 129, 0.4);
    border-color: rgba(52, 211, 153, 0.6);
    font-weight: 600;
    box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
}

.hero-indicator .indicator-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: rgba(255, 255, 255, 0.2);
    display: none;
    overflow: hidden;
}

.hero-indicator.active .indicator-progress {
    display: block;
}

.hero-indicator.active .progress-fill {
    display: block;
    height: 100%;
    width: 0%;
    background: #34d399;
}

/* Navigation Arrow Buttons */
.hero-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(3, 30, 22, 0.55);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 4;
    transition: all 0.3s ease;
    opacity: 0.75;
}

.hero-nav-btn:hover {
    opacity: 1;
    background: rgba(16, 185, 129, 0.75);
    border-color: rgba(255, 255, 255, 0.6);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
}

.hero-nav-btn.prev-btn {
    left: 24px;
}

.hero-nav-btn.next-btn {
    right: 24px;
}

@media (max-width: 991px) {
    .hero-nav-btn {
        display: none;
    }
    .hero-indicator .indicator-label {
        display: none;
    }
    .hero-indicator {
        padding: 8px 12px;
        font-size: 15px;
    }
}

/* Gallery Section */
.gallery-section {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 50%, #fee2e2 100%);
    width: 100vw;
    padding: 80px 0;
    margin: 0;
}

/* Fullscreen Feature Section */
.feature-section {
    background: #ffffff;
    width: 100vw;
    padding: 80px 0;
    margin: 0;
}

/* Fullscreen CTA Section */
.cta-section {
    background: #f8fafc;
    width: 100vw;
    padding: 80px 0;
    margin: 0;
}

/* Card Styles */
.card-clean {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    background: #ffffff;
}

.card-clean:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

/* Gallery Card Styles */
.gallery-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    transition: all 0.4s ease;
    background: #ffffff;
    position: relative;
}

.gallery-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
}

.gallery-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: all 0.3s ease;
}

.gallery-card:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    color: white;
    padding: 20px;
    transform: translateY(100%);
    transition: all 0.3s ease;
}

.gallery-card:hover .gallery-overlay {
    transform: translateY(0);
}

.gallery-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(239, 68, 68, 0.9);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

/* Button Styles */
.btn-primary-custom {
    background: #10b981;
    border: none;
    border-radius: 12px;
    padding: 14px 32px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    background: #059669;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.btn-outline-custom {
    border: 2px solid #ffffff;
    color: #ffffff;
    background: transparent;
    border-radius: 12px;
    padding: 12px 32px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn-outline-custom:hover {
    background: #ffffff;
    color: #10b981;
    transform: translateY(-2px);
}

/* Stats Card */
.stats-card-clean {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 32px;
}

.stats-item {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    transition: all 0.3s ease;
}

.stats-item:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.05);
}

/* Feature Icons */
.feature-icon-clean {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 24px;
    transition: all 0.3s ease;
}

.feature-icon-clean:hover {
    transform: scale(1.1);
}

/* Typography */
.display-custom {
    font-weight: 800;
    line-height: 1.1;
}

.text-muted-custom {
    color: #64748b;
}

/* Clean Badge */
.badge-clean {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    padding: 8px 20px;
    font-weight: 500;
    font-size: 14px;
}

/* Animations */
.fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Container for content inside fullscreen sections */
.content-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

@media (min-width: 768px) {
    .content-container {
        padding: 0 40px;
    }
}

@media (min-width: 992px) {
    .content-container {
        padding: 0 60px;
    }
}

/* Responsive navbar spacing */
@media (max-width: 768px) {
    .hero-section {
        padding: 110px 0 90px 0;
        min-height: auto;
    }

    .gallery-image {
        height: 200px;
    }

    .badge-nature-scene {
        font-size: 12px;
        padding: 6px 14px;
    }
}

/* Gallery Modal Styles */
.modal-gallery {
    background: rgba(0, 0, 0, 0.9);
}

.modal-gallery .modal-content {
    background: transparent;
    border: none;
}

.modal-gallery .modal-body {
    padding: 0;
}

.modal-gallery img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}
</style>

<div class="main-content">
    <!-- Hero Section with Dynamic Nature Slideshow -->
    <section class="hero-section text-white position-relative" id="heroSection">
        <!-- Background Nature Slideshow -->
        <div class="hero-slider" id="heroSlider">
            <!-- Slide 1: Green Mountains -->
            <div class="hero-slide active" 
                 style="background-image: url('{{ asset('images/hero/gunung.jpg') }}'), url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=2070&auto=format&fit=crop');" 
                 data-index="0" 
                 data-badge="🏔️ Lush Green Mountains"></div>
            <!-- Slide 2: Vast Fields -->
            <div class="hero-slide" 
                 style="background-image: url('{{ asset('images/hero/tanaman.jpg') }}'), url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2070&auto=format&fit=crop');" 
                 data-index="1" 
                 data-badge="🌾 Expansive Green Fields & Valleys"></div>
            <!-- Slide 3: Clean Rivers -->
            <div class="hero-slide" 
                 style="background-image: url('{{ asset('images/hero/sungai.jpg') }}'), url('https://images.unsplash.com/photo-1437482078695-73f5ca6c96e2?q=80&w=2070&auto=format&fit=crop');" 
                 data-index="2" 
                 data-badge="💧 Pristine Streams & Clean Rivers"></div>
            <!-- Slide 4: Plantations -->
            <div class="hero-slide" 
                 style="background-image: url('{{ asset('images/hero/kebun.jpg') }}'), url('https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?q=80&w=2070&auto=format&fit=crop');" 
                 data-index="3" 
                 data-badge="🌿 Sustainable Green Plantations"></div>
        </div>

        <!-- Overlays for Readability & Ambiance -->
        <div class="hero-overlay"></div>
        <div class="hero-vignette"></div>

        <div class="content-container position-relative" style="z-index: 3;">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in-up">
                    <!-- Badges -->
                    <div class="mb-4 d-flex flex-wrap gap-2 align-items-center">
                        <span class="badge-clean">
                            🌍 #1 Environmental Action Platform
                        </span>
                        <span class="badge-nature-scene" id="natureSceneBadge">
                            🏔️ Lush Green Mountains
                        </span>
                    </div>

                    <!-- Main Title -->
                    <h1 class="display-2 display-custom mb-4">
                        🌱 EcoTrack<span class="text-warning">.ID</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="fs-4 fw-light mb-4 opacity-90">
                        "Track Your Green Action, Impact the Earth."
                    </p>

                    <!-- Description -->
                    <p class="fs-5 mb-5 opacity-90">
                        A collaborative platform to monitor, report, and take meaningful action for a cleaner planet.
                        Join over <strong class="text-warning">10,000+</strong> eco-heroes today!
                    </p>

                    <!-- CTA Buttons -->
                    <div class="d-flex flex-wrap gap-3 mb-5">
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3 rounded-3 fw-semibold shadow-sm">
                            Get Started Now →
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-custom">
                            Sign In
                        </a>
                        @else
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-4 py-3 rounded-3 fw-semibold shadow-sm">
                            Go to Dashboard 📊
                        </a>
                        @endguest
                    </div>

                    <!-- Stats -->
                    <div class="row mt-5">
                        <div class="col-4 text-center">
                            <h3 class="fw-bold mb-1 display-6">10K+</h3>
                            <small class="opacity-75">Active Users</small>
                        </div>
                        <div class="col-4 text-center">
                            <h3 class="fw-bold mb-1 display-6">5K+</h3>
                            <small class="opacity-75">Reports Filed</small>
                        </div>
                        <div class="col-4 text-center">
                            <h3 class="fw-bold mb-1 display-6">500+</h3>
                            <small class="opacity-75">Green Spots</small>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Environmental Damage Stats -->
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="stats-card-clean">
                        <h5 class="mb-4 fw-semibold text-danger">
                            ⚠️ Environmental Crisis Caused by Unchecked Waste
                        </h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="fs-2 mb-2">🗑️</div>
                                    <small class="d-block mb-1">Daily Waste</small>
                                    <h4 class="fw-bold mb-0 text-danger">2.5 Tons</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="fs-2 mb-2">🏭</div>
                                    <small class="d-block mb-1">Air Pollution</small>
                                    <h4 class="fw-bold mb-0 text-warning">High</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="fs-2 mb-2">🌊</div>
                                    <small class="d-block mb-1">Polluted Waters</small>
                                    <h4 class="fw-bold mb-0 text-primary">65%</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="fs-2 mb-2">🌳</div>
                                    <small class="d-block mb-1">Forest Loss</small>
                                    <h4 class="fw-bold mb-0 text-success">12 Ha</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button class="hero-nav-btn prev-btn" id="heroPrevBtn" aria-label="Previous Slide" type="button">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="hero-nav-btn next-btn" id="heroNextBtn" aria-label="Next Slide" type="button">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Slider Indicators Navigation Bar -->
        <div class="hero-indicators-container">
            <div class="hero-indicators">
                <button class="hero-indicator active" data-slide-index="0" type="button" aria-label="View Green Mountains">
                    <span class="indicator-icon">🏔️</span>
                    <span class="indicator-label">Green Mountains</span>
                    <span class="indicator-progress"><span class="progress-fill"></span></span>
                </button>
                <button class="hero-indicator" data-slide-index="1" type="button" aria-label="View Vast Fields">
                    <span class="indicator-icon">🌾</span>
                    <span class="indicator-label">Vast Fields</span>
                    <span class="indicator-progress"><span class="progress-fill"></span></span>
                </button>
                <button class="hero-indicator" data-slide-index="2" type="button" aria-label="View Clean Rivers">
                    <span class="indicator-icon">💧</span>
                    <span class="indicator-label">Clean Rivers</span>
                    <span class="indicator-progress"><span class="progress-fill"></span></span>
                </button>
                <button class="hero-indicator" data-slide-index="3" type="button" aria-label="View Lush Plantations">
                    <span class="indicator-icon">🌿</span>
                    <span class="indicator-label">Lush Plantations</span>
                    <span class="indicator-progress"><span class="progress-fill"></span></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Gallery Section - Environmental Pollution Documentation -->
    <section class="gallery-section">
        <div class="content-container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-danger mb-3">
                    📸 Environmental Pollution Documentation
                </h2>
                <p class="fs-5 text-dark col-lg-8 mx-auto">
                    A curated archive of real-world environmental pollution cases documented across multiple regions.
                    Together, we can raise awareness and take action for a cleaner world.
                </p>
            </div>

            <!-- Gallery Grid -->
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://images.unsplash.com/photo-1712700639901-7dd3a5173d99?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        data-title="Plastic Waste in Urban River"
                        data-description="Massive plastic waste accumulation clogging the river canal system">
                        <img src="https://images.unsplash.com/photo-1712700639901-7dd3a5173d99?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Plastic Waste in Urban River" class="gallery-image">
                        <div class="gallery-badge">Critical</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Plastic Waste in Urban River</h6>
                            <p class="mb-0 small">North Jakarta - Jan 15, 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://images.unsplash.com/photo-1681504787493-c5e3b8c16813?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        data-title="Industrial Factory Air Pollution"
                        data-description="Dense black exhaust emissions from industrial chimneys polluting urban air">
                        <img src="https://images.unsplash.com/photo-1681504787493-c5e3b8c16813?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Industrial Factory Air Pollution" class="gallery-image">
                        <div class="gallery-badge">Hazardous</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Industrial Air Pollution</h6>
                            <p class="mb-0 small">Industrial Zone - Jan 12, 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://images.pexels.com/photos/3174350/pexels-photo-3174350.jpeg"
                        data-title="Overloaded Landfill Waste"
                        data-description="Overburdened municipal landfill reaching peak capacity and generating hazardous odors">
                        <img src="https://images.pexels.com/photos/3174350/pexels-photo-3174350.jpeg"
                            alt="Overloaded Landfill Waste" class="gallery-image">
                        <div class="gallery-badge">Urgent</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Overloaded Landfill Waste</h6>
                            <p class="mb-0 small">City Landfill - Jan 10, 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://images.bisnis.com/posts/2020/09/05/1287765/pencemaran-laut-reuters-erik-de-castro-msl.jpg"
                        data-title="Marine Water Pollution"
                        data-description="Industrial effluents and runoff polluting marine waters and threatening coastal biodiversity">
                        <img src="https://images.bisnis.com/posts/2020/09/05/1287765/pencemaran-laut-reuters-erik-de-castro-msl.jpg"
                            alt="Marine Water Pollution" class="gallery-image">
                        <div class="gallery-badge">Critical</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Marine Water Pollution</h6>
                            <p class="mb-0 small">Coastal Bay - Jan 8, 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://mutucertification.com/wp-content/uploads/2023/08/Apa-Itu-Deforestasi-Hutan-Berikut-Dampak-dan-Pencegahannya-1.jpg"
                        data-title="Forest Deforestation"
                        data-description="Illegal logging and land clearance destroying rainforest habitats and biodiversity">
                        <img src="https://mutucertification.com/wp-content/uploads/2023/08/Apa-Itu-Deforestasi-Hutan-Berikut-Dampak-dan-Pencegahannya-1.jpg"
                            alt="Forest Deforestation" class="gallery-image">
                        <div class="gallery-badge">Emergency</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Rainforest Deforestation</h6>
                            <p class="mb-0 small">Rainforest Region - Jan 5, 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://citarumharum.jabarprov.go.id/eusina/uploads/2025/02/limbah-elektronik.png"
                        data-title="Electronic E-Waste"
                        data-description="Hazardous electronic and battery waste dumped without safe disposal standards">
                        <img src="https://citarumharum.jabarprov.go.id/eusina/uploads/2025/02/limbah-elektronik.png"
                            alt="Electronic E-Waste" class="gallery-image">
                        <div class="gallery-badge">Hazardous</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Electronic E-Waste</h6>
                            <p class="mb-0 small">Industrial Suburb - Jan 3, 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center">
                <h4 class="fw-bold text-dark mb-3">Have Photos of Environmental Issues?</h4>
                <p class="text-muted mb-4">Report and share photos of pollution around your area to accelerate cleanup and mobilize local communities.</p>
                <a href="{{ route('register') }}" class="btn btn-danger btn-lg px-5 py-3 rounded-3 fw-semibold">
                    📷 Submit a Report Now
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section">
        <div class="content-container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-dark mb-3">Core Platform Features</h2>
                <p class="fs-5 text-muted-custom col-lg-6 mx-auto">
                    Three essential pillars empowering EcoTrack.ID as the premier collaborative environmental action platform
                </p>
            </div>

            <!-- Feature Cards -->
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card-clean h-100 p-4 text-center">
                        <div class="feature-icon-clean text-white mx-auto"
                            style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                            🚨
                        </div>
                        <h3 class="fw-bold mb-3">Citizen Reporting</h3>
                        <p class="text-muted-custom mb-4">
                            Spot illegal trash dumping or unauthorized logging? Report directly from your location and enable swift mobilization from community groups and authorities.
                        </p>
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                            Real-time Reporting
                        </span>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-clean h-100 p-4 text-center">
                        <div class="feature-icon-clean text-white mx-auto"
                            style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            🏆
                        </div>
                        <h3 class="fw-bold mb-3">Eco-Challenges</h3>
                        <p class="text-muted-custom mb-4">
                            Join weekly green challenges such as plastic reduction or tree planting. Earn reward points, collect badges, and become a sustainability leader.
                        </p>
                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                            Gamification
                        </span>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-clean h-100 p-4 text-center">
                        <div class="feature-icon-clean text-white mx-auto"
                            style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                            🗺
                        </div>
                        <h3 class="fw-bold mb-3">Green Map</h3>
                        <p class="text-muted-custom mb-4">
                            Find nearby waste banks, drop-off recycling hubs, and eco-parks. Mark new green points to guide fellow citizens to sustainable resources.
                        </p>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                            Interactive Map
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="content-container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="display-4 fw-bold text-dark mb-4">Ready to Become an Eco Hero?</h2>
                    <p class="fs-5 text-muted-custom mb-5">
                        Join thousands of dedicated changemakers committed to preserving our planet.
                        Begin your green journey today!
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg">
                            Get Started - Free!
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-3">
                            Sign In to Account
                        </a>
                        @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary-custom btn-lg">
                            Go to Dashboard
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Gallery Modal -->
<div class="modal fade modal-gallery" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="galleryModalLabel">Pollution Photo Evidence</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="/placeholder.svg" alt="" class="img-fluid">
                <div class="mt-3 text-white">
                    <h6 id="modalTitle" class="fw-bold"></h6>
                    <p id="modalDescription" class="mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Dynamic Nature Hero Slideshow & Gallery Script
document.addEventListener('DOMContentLoaded', function() {
    // ----------------------------------------------------
    // Hero Slideshow Controller
    // ----------------------------------------------------
    const slides = document.querySelectorAll('.hero-slide');
    const indicators = document.querySelectorAll('.hero-indicator');
    const sceneBadge = document.getElementById('natureSceneBadge');
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');
    const heroSection = document.getElementById('heroSection');

    if (slides.length > 0) {
        let currentIndex = 0;
        const slideDuration = 5500; // 5.5 seconds per slide
        let slideTimer = null;
        let progressAnimFrame = null;
        let progressStartTime = null;
        let isPaused = false;

        function goToSlide(index) {
            if (index === currentIndex && slides[currentIndex].classList.contains('active')) {
                return;
            }

            // Remove active state from current
            slides[currentIndex].classList.remove('active');
            indicators[currentIndex].classList.remove('active');

            const prevFill = indicators[currentIndex].querySelector('.progress-fill');
            if (prevFill) {
                prevFill.style.width = '0%';
            }

            // Update index with loop wrap-around
            currentIndex = (index + slides.length) % slides.length;

            // Activate new slide
            slides[currentIndex].classList.add('active');
            indicators[currentIndex].classList.add('active');

            // Smooth badge text transition
            if (sceneBadge) {
                const badgeText = slides[currentIndex].getAttribute('data-badge');
                sceneBadge.style.opacity = '0';
                sceneBadge.style.transform = 'translateY(-4px)';
                setTimeout(() => {
                    sceneBadge.textContent = badgeText;
                    sceneBadge.style.opacity = '1';
                    sceneBadge.style.transform = 'translateY(0)';
                }, 220);
            }

            startTimer();
        }

        function startTimer() {
            clearInterval(slideTimer);
            if (progressAnimFrame) {
                cancelAnimationFrame(progressAnimFrame);
            }

            progressStartTime = performance.now();

            function updateProgress(now) {
                if (isPaused) {
                    progressStartTime += 16; // compensate while paused
                    progressAnimFrame = requestAnimationFrame(updateProgress);
                    return;
                }

                const elapsed = now - progressStartTime;
                const progressPct = Math.min(100, (elapsed / slideDuration) * 100);

                const currentFill = indicators[currentIndex].querySelector('.progress-fill');
                if (currentFill) {
                    currentFill.style.width = progressPct + '%';
                }

                if (elapsed < slideDuration) {
                    progressAnimFrame = requestAnimationFrame(updateProgress);
                }
            }

            progressAnimFrame = requestAnimationFrame(updateProgress);

            slideTimer = setTimeout(() => {
                if (!isPaused) {
                    goToSlide(currentIndex + 1);
                } else {
                    startTimer();
                }
            }, slideDuration);
        }

        // Indicator click listeners
        indicators.forEach((indicator) => {
            indicator.addEventListener('click', function() {
                const targetIdx = parseInt(this.getAttribute('data-slide-index'), 10);
                goToSlide(targetIdx);
            });
        });

        // Prev / Next button listeners
        if (prevBtn) {
            prevBtn.addEventListener('click', function(e) {
                e.preventDefault();
                goToSlide(currentIndex - 1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                goToSlide(currentIndex + 1);
            });
        }

        // Pause on mouse hover over controls
        const indicatorsBar = document.querySelector('.hero-indicators');
        if (indicatorsBar) {
            indicatorsBar.addEventListener('mouseenter', () => { isPaused = true; });
            indicatorsBar.addEventListener('mouseleave', () => { isPaused = false; });
        }

        // Touch Swipe gestures for Mobile
        if (heroSection) {
            let touchStartX = 0;
            let touchEndX = 0;

            heroSection.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            heroSection.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 50) {
                    if (diff > 0) {
                        goToSlide(currentIndex + 1); // Swiped left -> next
                    } else {
                        goToSlide(currentIndex - 1); // Swiped right -> prev
                    }
                }
            }, { passive: true });
        }

        // Keyboard arrow navigation
        document.addEventListener('keydown', function(e) {
            if (e.target && ['INPUT', 'TEXTAREA', 'SELECT'].includes(e.target.tagName)) return;
            if (e.key === 'ArrowRight') {
                goToSlide(currentIndex + 1);
            } else if (e.key === 'ArrowLeft') {
                goToSlide(currentIndex - 1);
            }
        });

        // Start initial slide rotation
        startTimer();
    }

    // ----------------------------------------------------
    // Gallery Modal Script
    // ----------------------------------------------------
    const galleryCards = document.querySelectorAll('.gallery-card');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');

    galleryCards.forEach(card => {
        card.addEventListener('click', function() {
            const image = this.getAttribute('data-image');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');

            modalImage.src = image;
            modalImage.alt = title;
            modalTitle.textContent = title;
            modalDescription.textContent = description;
        });
    });
});
</script>

@endsection