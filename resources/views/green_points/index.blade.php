@extends('layouts.app')

@section('title', 'Peta Hijau Komunitas - EcoTrack.ID')

@section('content')
<style>
.green-map-hero {
    background: linear-gradient(135deg, #059669 0%, #047857 50%, #065f46 100%);
    border-radius: 20px;
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
}

.green-map-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M30 30c0-8.3-6.7-15-15-15s-15 6.7-15 15 6.7 15 15 15 15-6.7 15-15zm15 0c0-8.3-6.7-15-15-15s-15 6.7-15 15 6.7 15 15 15 15-6.7 15-15z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    animation: float 30s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateX(0) translateY(0);
    }

    50% {
        transform: translateX(-20px) translateY(-20px);
    }
}

.hero-content {
    position: relative;
    z-index: 1;
    padding: 2.5rem 2rem;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.15);
    color: rgba(255, 255, 255, 0.95);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    line-height: 1.5;
}

.hero-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1rem;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
}

/* Alert Styling */
.alert-modern {
    border: none;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border-left: 4px solid;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
}

.alert-success-modern {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border-left-color: #10b981;
    color: #065f46;
}

.alert-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    margin-right: 0.75rem;
    flex-shrink: 0;
    background: #10b981;
    color: white;
}

.alert-content {
    flex: 1;
}

.alert-text {
    margin: 0;
    font-weight: 500;
}

/* Map Section */
.map-section {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    margin-bottom: 2rem;
}

.map-header {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.map-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.title-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #059669, #047857);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.map-controls {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.btn-map {
    padding: 0.5rem 1rem;
    border: 2px solid #e5e7eb;
    background: white;
    color: #374151;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-map:hover {
    background: #f3f4f6;
    border-color: #059669;
    color: #047857;
}

.btn-map.active {
    background: #059669;
    border-color: #059669;
    color: white;
}

/* Map Container */
.map-container {
    position: relative;
    height: 600px;
    background: #f3f4f6;
}

#map {
    height: 600px;
    width: 100%;
    z-index: 1;
}

.map-overlay {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: white;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    max-width: 280px;
}

.overlay-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.overlay-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.overlay-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0;
    font-size: 0.875rem;
    color: #6b7280;
    border-bottom: 1px solid #f3f4f6;
}

.overlay-item:last-child {
    border-bottom: none;
}

.overlay-icon {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    flex-shrink: 0;
}

.icon-bank-sampah {
    background: #10b981;
}

.icon-taman {
    background: #059669;
}

.icon-tempat-daur-ulang {
    background: #0d9488;
}

.icon-komunitas-hijau {
    background: #047857;
}

.map-legend {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    background: white;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
}

.legend-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    color: #6b7280;
    margin-bottom: 0.25rem;
}

.legend-item:last-child {
    margin-bottom: 0;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
}

/* Action Section */
.action-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    text-align: center;
}

.action-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.action-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #059669, #047857);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.action-description {
    font-size: 1rem;
    color: #6b7280;
    margin-bottom: 2rem;
    line-height: 1.5;
}

.btn-primary-modern {
    background: linear-gradient(135deg, #059669, #047857);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    overflow: hidden;
}

.btn-primary-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-primary-modern:hover::before {
    left: 100%;
}

.btn-primary-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
    color: white;
}

/* Info Cards */
.info-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.info-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    text-align: center;
}

.info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    border-color: #059669;
}

.card-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1rem;
    color: white;
}

.card-icon.bank-sampah {
    background: linear-gradient(135deg, #10b981, #059669);
}

.card-icon.taman {
    background: linear-gradient(135deg, #059669, #047857);
}

.card-icon.daur-ulang {
    background: linear-gradient(135deg, #0d9488, #0f766e);
}

.card-icon.komunitas {
    background: linear-gradient(135deg, #047857, #065f46);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.card-description {
    font-size: 0.875rem;
    color: #6b7280;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.card-count {
    font-size: 2rem;
    font-weight: 800;
    color: #059669;
    margin-bottom: 0.25rem;
}

.card-label {
    font-size: 0.75rem;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Loading State */
.map-loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    text-align: center;
    z-index: 2000;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f4f6;
    border-top: 4px solid #059669;
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

.loading-text {
    font-size: 1rem;
    font-weight: 500;
    color: #6b7280;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-stats {
        flex-direction: column;
        gap: 1rem;
    }

    .stat-item {
        width: 100%;
        justify-content: center;
    }

    .map-header {
        flex-direction: column;
        align-items: stretch;
        padding: 1.5rem;
    }

    .map-controls {
        justify-content: center;
    }

    .map-container,
    #map {
        height: 400px;
    }

    .map-overlay,
    .map-legend {
        position: relative;
        margin: 1rem;
        max-width: none;
    }

    .hero-content {
        padding: 2rem 1.5rem;
    }

    .action-section {
        padding: 1.5rem;
    }

    .btn-primary-modern {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .info-cards {
        grid-template-columns: 1fr;
    }

    .map-controls {
        flex-direction: column;
    }

    .btn-map {
        width: 100%;
        justify-content: center;
    }
}
</style>

<!-- Success Alert -->
@if(session('success'))
<div class="alert-modern alert-success-modern">
    <div class="alert-icon">
        <i class="fas fa-check"></i>
    </div>
    <div class="alert-content">
        <div class="alert-text">{{ session('success') }}</div>
    </div>
</div>
@endif

<!-- Hero Section -->
<div class="green-map-hero">
    <div class="hero-content">
        <div class="hero-badge">
            🌱 Peta Hijau Komunitas
        </div>
        <h1 class="hero-title">Jelajahi Lokasi Ramah Lingkungan</h1>
        <p class="hero-subtitle">
            Temukan dan bagikan lokasi-lokasi hijau seperti Bank Sampah, Taman Kota,
            Tempat Daur Ulang, dan komunitas peduli lingkungan di sekitar Anda.
        </p>

        <div class="hero-stats">
            <div class="stat-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <div class="stat-number">{{ $greenPoints->count() }}</div>
                    <div class="stat-label">Titik Hijau</div>
                </div>
            </div>
            <div class="stat-item">
                <i class="fas fa-recycle"></i>
                <div>
                    <div class="stat-number">{{ $greenPoints->where('type', 'Bank Sampah')->count() }}</div>
                    <div class="stat-label">Bank Sampah</div>
                </div>
            </div>
            <div class="stat-item">
                <i class="fas fa-tree"></i>
                <div>
                    <div class="stat-number">{{ $greenPoints->where('type', 'Taman')->count() }}</div>
                    <div class="stat-label">Taman Hijau</div>
                </div>
            </div>
            <div class="stat-item">
                <i class="fas fa-users"></i>
                <div>
                    <div class="stat-number">{{ $greenPoints->where('type', 'Komunitas Hijau')->count() }}</div>
                    <div class="stat-label">Komunitas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Cards -->
<div class="info-cards">
    <div class="info-card">
        <div class="card-icon bank-sampah">
            <i class="fas fa-recycle"></i>
        </div>
        <h3 class="card-title">Bank Sampah</h3>
        <p class="card-description">Tempat pengumpulan dan pengelolaan sampah untuk didaur ulang</p>
        <div class="card-count">{{ $greenPoints->where('type', 'Bank Sampah')->count() }}</div>
        <div class="card-label">Lokasi Tersedia</div>
    </div>

    <div class="info-card">
        <div class="card-icon taman">
            <i class="fas fa-tree"></i>
        </div>
        <h3 class="card-title">Taman Hijau</h3>
        <p class="card-description">Ruang terbuka hijau untuk rekreasi dan paru-paru kota</p>
        <div class="card-count">{{ $greenPoints->where('type', 'Taman')->count() }}</div>
        <div class="card-label">Lokasi Tersedia</div>
    </div>

    <div class="info-card">
        <div class="card-icon daur-ulang">
            <i class="fas fa-sync-alt"></i>
        </div>
        <h3 class="card-title">Tempat Daur Ulang</h3>
        <p class="card-description">Fasilitas khusus untuk mendaur ulang berbagai jenis material</p>
        <div class="card-count">{{ $greenPoints->where('type', 'Tempat Daur Ulang')->count() }}</div>
        <div class="card-label">Lokasi Tersedia</div>
    </div>

    <div class="info-card">
        <div class="card-icon komunitas">
            <i class="fas fa-users"></i>
        </div>
        <h3 class="card-title">Komunitas Hijau</h3>
        <p class="card-description">Kelompok masyarakat yang aktif dalam kegiatan lingkungan</p>
        <div class="card-count">{{ $greenPoints->where('type', 'Komunitas Hijau')->count() }}</div>
        <div class="card-label">Lokasi Tersedia</div>
    </div>
</div>

<!-- Map Section -->
<div class="map-section">
    <div class="map-header">
        <h2 class="map-title">
            <div class="title-icon">
                <i class="fas fa-map"></i>
            </div>
            Peta Interaktif
        </h2>
        <div class="map-controls">
            <button class="btn-map active" id="showAllBtn">
                <i class="fas fa-globe"></i>
                Tampilkan Semua
            </button>
            <button class="btn-map" id="locateBtn">
                <i class="fas fa-crosshairs"></i>
                Lokasi Saya
            </button>
            <button class="btn-map" id="fullscreenBtn">
                <i class="fas fa-expand"></i>
                Layar Penuh
            </button>
        </div>
    </div>

    <div class="map-container">
        <!-- Loading State -->
        <div class="map-loading" id="mapLoading">
            <div class="loading-spinner"></div>
            <div class="loading-text">Memuat peta...</div>
        </div>

        <!-- Map -->
        <div id="map"></div>

        <!-- Map Overlay -->
        <div class="map-overlay">
            <div class="overlay-title">
                <i class="fas fa-info-circle"></i>
                Kategori Lokasi
            </div>
            <ul class="overlay-list">
                <li class="overlay-item">
                    <div class="overlay-icon icon-bank-sampah"></div>
                    <span>Bank Sampah</span>
                </li>
                <li class="overlay-item">
                    <div class="overlay-icon icon-taman"></div>
                    <span>Taman Hijau</span>
                </li>
                <li class="overlay-item">
                    <div class="overlay-icon icon-tempat-daur-ulang"></div>
                    <span>Tempat Daur Ulang</span>
                </li>
                <li class="overlay-item">
                    <div class="overlay-icon icon-komunitas-hijau"></div>
                    <span>Komunitas Hijau</span>
                </li>
            </ul>
        </div>

        <!-- Map Legend -->
        <div class="map-legend">
            <div class="legend-title">Keterangan</div>
            <div class="legend-item">
                <div class="legend-color" style="background: #10b981;"></div>
                <span>Bank Sampah</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #059669;"></div>
                <span>Taman</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #0d9488;"></div>
                <span>Daur Ulang</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #047857;"></div>
                <span>Komunitas</span>
            </div>
        </div>
    </div>
</div>

<!-- Action Section -->
<div class="action-section">
    <h3 class="action-title">
        <div class="action-icon">
            <i class="fas fa-plus"></i>
        </div>
        Kontribusi untuk Komunitas
    </h3>
    <p class="action-description">
        Bantu komunitas dengan menambahkan lokasi hijau baru yang Anda ketahui.
        Setiap kontribusi Anda akan membantu orang lain menemukan tempat-tempat ramah lingkungan.
    </p>
    <a href="{{ route('green-map.create') }}" class="btn-primary-modern">
        <i class="fas fa-map-marker-alt"></i>
        Tambah Titik Hijau Baru
    </a>
</div>

<script>
// Wait for page to fully load
document.addEventListener('DOMContentLoaded', function() {
    // Hide loading after a short delay
    setTimeout(() => {
        document.getElementById('mapLoading').style.display = 'none';
        initializeMap();
    }, 1000);
});

function initializeMap() {
    // Check if Leaflet is loaded
    if (typeof L === 'undefined') {
        console.error('Leaflet not loaded');
        return;
    }

    // Initialize map
    var map = L.map('map').setView([-6.2088, 106.8456], 11);

    // Add tile layer with better styling
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Custom icons for different types
    const icons = {
        'Bank Sampah': L.divIcon({
            html: '<div style="background: #10b981; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"><i class="fas fa-recycle"></i></div>',
            className: 'custom-div-icon',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        }),
        'Taman': L.divIcon({
            html: '<div style="background: #059669; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"><i class="fas fa-tree"></i></div>',
            className: 'custom-div-icon',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        }),
        'Tempat Daur Ulang': L.divIcon({
            html: '<div style="background: #0d9488; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"><i class="fas fa-sync-alt"></i></div>',
            className: 'custom-div-icon',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        }),
        'Komunitas Hijau': L.divIcon({
            html: '<div style="background: #047857; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"><i class="fas fa-users"></i></div>',
            className: 'custom-div-icon',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        })
    };

    // Add markers
    const greenPoints = @json($greenPoints);
    const markers = [];

    greenPoints.forEach(point => {
        const icon = icons[point.type] || icons['Taman'];

        const marker = L.marker([point.latitude, point.longitude], {
                icon: icon
            })
            .addTo(map)
            .bindPopup(`
                <div style="min-width: 200px;">
                    <h5 style="margin: 0 0 8px 0; color: #1f2937; font-weight: 600;">${point.name}</h5>
                    <p style="margin: 0 0 8px 0; color: #059669; font-size: 14px; font-weight: 500;">
                        <i class="fas fa-tag"></i> ${point.type}
                    </p>
                    <p style="margin: 0 0 8px 0; color: #6b7280; font-size: 14px; line-height: 1.4;">
                        ${point.description}
                    </p>
                    <div style="padding-top: 8px; border-top: 1px solid #e5e7eb; font-size: 12px; color: #9ca3af;">
                        <i class="fas fa-map-marker-alt"></i> 
                        ${parseFloat(point.latitude).toFixed(4)}, ${parseFloat(point.longitude).toFixed(4)}
                    </div>
                </div>
            `);

        markers.push(marker);
    });

    // Control buttons functionality
    document.getElementById('showAllBtn').addEventListener('click', function() {
        if (markers.length > 0) {
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.1));
        }
        updateActiveButton(this);
    });

    document.getElementById('locateBtn').addEventListener('click', function() {
        const btn = this;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';
        btn.classList.add('active');

        map.locate({
            setView: true,
            maxZoom: 16,
            timeout: 10000,
            enableHighAccuracy: true
        });

        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-crosshairs"></i> Lokasi Saya';
            updateActiveButton(btn);
        }, 3000);
    });

    document.getElementById('fullscreenBtn').addEventListener('click', function() {
        if (map.isFullscreen()) {
            map.toggleFullscreen();
        } else {
            map.toggleFullscreen();
        }
        updateActiveButton(this);
    });

    // Location found/error handlers
    map.on('locationfound', function(e) {
        L.circle(e.latlng, {
            radius: e.accuracy / 2,
            fillColor: '#059669',
            fillOpacity: 0.2,
            color: '#059669',
            weight: 2
        }).addTo(map);

        L.marker(e.latlng, {
            icon: L.divIcon({
                html: '<div style="background: #ef4444; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"></div>',
                className: 'user-location-icon',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            })
        }).addTo(map).bindPopup('Lokasi Anda').openPopup();
    });

    map.on('locationerror', function(e) {
        console.log('Location error:', e.message);
        alert('Tidak dapat mendeteksi lokasi Anda. Pastikan GPS aktif dan izinkan akses lokasi.');
    });

    function updateActiveButton(activeBtn) {
        document.querySelectorAll('.btn-map').forEach(btn => {
            btn.classList.remove('active');
        });
        activeBtn.classList.add('active');
    }

    // Ensure map renders properly
    setTimeout(() => {
        map.invalidateSize();
    }, 100);
}

// Auto-hide success alert
document.querySelectorAll('.alert-modern').forEach(alert => {
    setTimeout(() => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            alert.remove();
        }, 300);
    }, 5000);
});

// Add smooth scrolling to map when page loads
window.addEventListener('load', function() {
    if (window.location.hash === '#map') {
        document.getElementById('map').scrollIntoView({
            behavior: 'smooth'
        });
    }
});
</script>
@endsection