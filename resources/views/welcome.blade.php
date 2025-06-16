@extends('layouts.app')

@section('title', 'EcoTrack.ID - Jejak Aksi Hijaumu, Dampak untuk Bumi')

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

/* Hero Section with proper navbar spacing */
.hero-section {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    min-height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    position: relative;
    margin: 0;
    padding: 120px 0 60px 0;
    margin-top: 0;
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
        padding: 100px 0 40px 0;
    }

    .gallery-image {
        height: 200px;
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
    <!-- Hero Section -->
    <section class="hero-section text-white">
        <div class="content-container">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in-up">
                    <!-- Badge -->
                    <div class="mb-4">
                        <span class="badge-clean">
                            🌍 Platform Lingkungan #1 di Indonesia
                        </span>
                    </div>

                    <!-- Main Title -->
                    <h1 class="display-2 display-custom mb-4">
                        🌱 EcoTrack<span class="text-warning">.ID</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="fs-4 fw-light mb-4 opacity-90">
                        "Jejak Aksi Hijaumu, Dampak untuk Bumi."
                    </p>

                    <!-- Description -->
                    <p class="fs-5 mb-5 opacity-85">
                        Platform kolaboratif untuk memantau, melaporkan, dan bertindak demi lingkungan yang lebih baik.
                        Bergabunglah dengan <strong class="text-warning">10,000+</strong> pahlawan hijau lainnya!
                    </p>

                    <!-- CTA Buttons -->
                    <div class="d-flex flex-wrap gap-3 mb-5">
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3 rounded-3 fw-semibold">
                            Daftar Sekarang →
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-custom">
                            Masuk
                        </a>
                        @else
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-4 py-3 rounded-3 fw-semibold">
                            Buka Dashboard 📊
                        </a>
                        @endguest
                    </div>

                    <!-- Stats -->
                    <div class="row mt-5">
                        <div class="col-4 text-center">
                            <h3 class="fw-bold mb-1 display-6">10K+</h3>
                            <small class="opacity-75">Pengguna Aktif</small>
                        </div>
                        <div class="col-4 text-center">
                            <h3 class="fw-bold mb-1 display-6">5K+</h3>
                            <small class="opacity-75">Laporan</small>
                        </div>
                        <div class="col-4 text-center">
                            <h3 class="fw-bold mb-1 display-6">500+</h3>
                            <small class="opacity-75">Titik Hijau</small>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Environmental Damage Stats -->
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="stats-card-clean">
                        <h5 class="mb-4 fw-semibold text-danger">
                            ⚠️ Rusaknya Lingkungan Karena Sampah Berserakan
                        </h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="fs-2 mb-2">🗑️</div>
                                    <small class="d-block mb-1">Sampah Harian</small>
                                    <h4 class="fw-bold mb-0 text-danger">2.5 Ton</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="fs-2 mb-2">🏭</div>
                                    <small class="d-block mb-1">Polusi Udara</small>
                                    <h4 class="fw-bold mb-0 text-warning">Tinggi</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="fs-2 mb-2">🌊</div>
                                    <small class="d-block mb-1">Air Tercemar</small>
                                    <h4 class="fw-bold mb-0 text-primary">65%</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="fs-2 mb-2">🌳</div>
                                    <small class="d-block mb-1">Hutan Hilang</small>
                                    <h4 class="fw-bold mb-0 text-success">12 Ha</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section - Foto Pencemaran Lingkungan -->
    <section class="gallery-section">
        <div class="content-container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-danger mb-3">
                    📸 Dokumentasi Pencemaran Lingkungan
                </h2>
                <p class="fs-5 text-dark col-lg-8 mx-auto">
                    Kumpulan foto-foto nyata pencemaran lingkungan yang terjadi di berbagai daerah.
                    Mari bersama-sama peduli dan bertindak untuk lingkungan yang lebih bersih.
                </p>
            </div>

            <!-- Gallery Grid -->
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://images.unsplash.com/photo-1712700639901-7dd3a5173d99?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        data-title="Sampah Plastik di Sungai"
                        data-description="Tumpukan sampah plastik yang mencemari sungai di Jakarta Utara">
                        <img src="https://images.unsplash.com/photo-1712700639901-7dd3a5173d99?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Sampah Plastik di Sungai" class="gallery-image">
                        <div class="gallery-badge">Kritis</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Sampah Plastik di Sungai</h6>
                            <p class="mb-0 small">Jakarta Utara - 15 Januari 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://images.unsplash.com/photo-1681504787493-c5e3b8c16813?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        data-title="Polusi Udara dari Pabrik"
                        data-description="Asap hitam pekat dari cerobong pabrik yang mencemari udara">
                        <img src="https://images.unsplash.com/photo-1681504787493-c5e3b8c16813?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Polusi Udara Pabrik" class="gallery-image">
                        <div class="gallery-badge">Berbahaya</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Polusi Udara dari Pabrik</h6>
                            <p class="mb-0 small">Bekasi - 12 Januari 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://images.pexels.com/photos/3174350/pexels-photo-3174350.jpeg"
                        data-title="Tumpukan Sampah di TPA"
                        data-description="Kondisi TPA yang sudah overload dan menimbulkan bau tidak sedap">
                        <img src="https://images.pexels.com/photos/3174350/pexels-photo-3174350.jpeg"
                            alt="Tumpukan Sampah TPA" class="gallery-image">
                        <div class="gallery-badge">Mendesak</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Tumpukan Sampah di TPA</h6>
                            <p class="mb-0 small">Depok - 10 Januari 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://images.bisnis.com/posts/2020/09/05/1287765/pencemaran-laut-reuters-erik-de-castro-msl.jpg"
                        data-title="Pencemaran Air Laut"
                        data-description="Limbah industri yang mencemari air laut dan merusak ekosistem">
                        <img src="https://images.bisnis.com/posts/2020/09/05/1287765/pencemaran-laut-reuters-erik-de-castro-msl.jpg"
                            alt="Pencemaran Air Laut" class="gallery-image">
                        <div class="gallery-badge">Kritis</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Pencemaran Air Laut</h6>
                            <p class="mb-0 small">Teluk Jakarta - 8 Januari 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://mutucertification.com/wp-content/uploads/2023/08/Apa-Itu-Deforestasi-Hutan-Berikut-Dampak-dan-Pencegahannya-1.jpg"
                        data-title="Deforestasi Hutan"
                        data-description="Penebangan liar yang merusak hutan dan habitat satwa">
                        <img src="https://mutucertification.com/wp-content/uploads/2023/08/Apa-Itu-Deforestasi-Hutan-Berikut-Dampak-dan-Pencegahannya-1.jpg"
                            alt="Deforestasi Hutan" class="gallery-image">
                        <div class="gallery-badge">Darurat</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Deforestasi Hutan</h6>
                            <p class="mb-0 small">Kalimantan - 5 Januari 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="https://citarumharum.jabarprov.go.id/eusina/uploads/2025/02/limbah-elektronik.png"
                        data-title="Sampah Elektronik"
                        data-description="Tumpukan e-waste yang tidak terkelola dengan baik">
                        <img src="https://citarumharum.jabarprov.go.id/eusina/uploads/2025/02/limbah-elektronik.png"
                            alt="Sampah Elektronik" class="gallery-image">
                        <div class="gallery-badge">Berbahaya</div>
                        <div class="gallery-overlay">
                            <h6 class="fw-bold mb-2">Sampah Elektronik</h6>
                            <p class="mb-0 small">Tangerang - 3 Januari 2024</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Call to Action -->
            <div class="text-center">
                <h4 class="fw-bold text-dark mb-3">Punya Foto Pencemaran Lingkungan?</h4>
                <p class="text-muted mb-4">Laporkan dan bagikan foto pencemaran lingkungan di sekitar Anda untuk
                    membantu meningkatkan kesadaran masyarakat</p>
                <a href="{{ route('register') }}" class="btn btn-danger btn-lg px-5 py-3 rounded-3 fw-semibold">
                    📷 Laporkan Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section">
        <div class="content-container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-dark mb-3">Fitur Unggulan Platform</h2>
                <p class="fs-5 text-muted-custom col-lg-6 mx-auto">
                    Tiga pilar utama yang membuat EcoTrack.ID menjadi platform terdepan dalam aksi lingkungan
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
                        <h3 class="fw-bold mb-3">Lapor Lingkungan</h3>
                        <p class="text-muted-custom mb-4">
                            Temukan tumpukan sampah atau penebangan liar? Laporkan langsung dari lokasi Anda dan
                            biarkan komunitas serta instansi terkait menindaklanjuti dengan cepat.
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
                        <h3 class="fw-bold mb-3">Eco-Challenge</h3>
                        <p class="text-muted-custom mb-4">
                            Ikuti tantangan hijau mingguan, seperti mengurangi plastik atau menanam pohon. Kumpulkan
                            poin, raih badge, dan jadilah juara lingkungan di komunitasmu.
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
                        <h3 class="fw-bold mb-3">Peta Hijau</h3>
                        <p class="text-muted-custom mb-4">
                            Temukan lokasi bank sampah, tempat daur ulang, dan taman kota terdekat. Tambahkan titik
                            hijau baru untuk membantu orang lain menemukan solusi ramah lingkungan.
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
                    <h2 class="display-4 fw-bold text-dark mb-4">Siap Menjadi Pahlawan Lingkungan?</h2>
                    <p class="fs-5 text-muted-custom mb-5">
                        Bergabunglah dengan ribuan orang yang sudah berkomitmen untuk menjaga bumi.
                        Mulai perjalanan hijau Anda hari ini!
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg">
                            Mulai Sekarang - Gratis!
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-3">
                            Pelajari Lebih Lanjut
                        </a>
                        @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary-custom btn-lg">
                            Lanjutkan ke Dashboard
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
                <h5 class="modal-title text-white" id="galleryModalLabel">Foto Pencemaran</h5>
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
// Gallery Modal Script
document.addEventListener('DOMContentLoaded', function() {
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