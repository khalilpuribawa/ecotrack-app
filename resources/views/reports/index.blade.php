@extends('layouts.app')

@section('title', 'Peta Laporan Lingkungan - EcoTrack.ID')

@section('content')
<style>
.map-hero {
    background: linear-gradient(135deg, #0f766e 0%, #0d9488 50%, #14b8a6 100%);
    border-radius: 20px;
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
}

.map-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='7' cy='7' r='7'/%3E%3Ccircle cx='53' cy='7' r='7'/%3E%3Ccircle cx='7' cy='53' r='7'/%3E%3Ccircle cx='53' cy='53' r='7'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    animation: float 20s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateX(0) translateY(0);
    }

    50% {
        transform: translateX(-30px) translateY(-30px);
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
    font-size: 2.25rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
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
    font-size: 1.25rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
}

/* Map Container */
.map-container {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    margin-bottom: 2rem;
    position: relative;
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
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.map-controls {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.control-btn {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid #d1d5db;
    background: white;
    color: #374151;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.control-btn:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
    transform: translateY(-1px);
    color: #374151;
}

.control-btn.active {
    background: #10b981;
    border-color: #10b981;
    color: white;
}

#map {
    height: 600px;
    width: 100%;
    position: relative;
}

/* Map Loading */
.map-loading {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    backdrop-filter: blur(4px);
}

.loading-content {
    text-align: center;
    color: #6b7280;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #e5e7eb;
    border-top: 3px solid #10b981;
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

/* Action Section */
.action-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    text-align: center;
}

.action-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin: 0 auto 1rem;
}

.action-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.action-subtitle {
    color: #6b7280;
    margin-bottom: 1.5rem;
    font-size: 1rem;
}

.action-btn {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    padding: 0.875rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.action-btn:hover::before {
    left: 100%;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    color: white;
}

/* Legend */
.map-legend {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: white;
    border-radius: 12px;
    padding: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 1px solid #e5e7eb;
    z-index: 1000;
    min-width: 200px;
}

.legend-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    font-size: 0.8rem;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.legend-color.user {
    background: #3b82f6;
}

.legend-color.report {
    background: #ef4444;
}

.legend-color.resolved {
    background: #10b981;
}

/* Success Alert */
.success-alert {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border: 1px solid #10b981;
    color: #065f46;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

.alert-icon {
    width: 24px;
    height: 24px;
    background: #10b981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.875rem;
}

/* Location Status */
.location-status {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    background: white;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    z-index: 1000;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.location-icon {
    width: 16px;
    height: 16px;
    border-radius: 50%;
}

.location-icon.active {
    background: #10b981;
    animation: pulse 2s infinite;
}

.location-icon.inactive {
    background: #ef4444;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    }

    70% {
        box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.75rem;
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
    }

    .map-controls {
        justify-content: center;
    }

    #map {
        height: 400px;
    }

    .map-legend {
        position: relative;
        top: auto;
        right: auto;
        margin: 1rem;
        width: calc(100% - 2rem);
    }

    .hero-content {
        padding: 2rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .control-btn {
        flex: 1;
        justify-content: center;
    }

    .action-section {
        padding: 1.5rem;
    }
}

/* Custom Leaflet Popup Styling */
.leaflet-popup-content-wrapper {
    border-radius: 12px !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}

.leaflet-popup-content {
    margin: 1rem !important;
    font-family: 'Inter', sans-serif !important;
}

.popup-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.popup-description {
    color: #6b7280;
    margin-bottom: 0.75rem;
    font-size: 0.875rem;
    line-height: 1.4;
}

.popup-meta {
    font-size: 0.75rem;
    color: #9ca3af;
    border-top: 1px solid #e5e7eb;
    padding-top: 0.5rem;
}
</style>

<!-- Success Alert -->
@if(session('success'))
<div class="success-alert">
    <div class="alert-icon">
        <i class="fas fa-check"></i>
    </div>
    <span>{{ session('success') }}</span>
</div>
@endif

<!-- Hero Section -->
<div class="map-hero">
    <div class="hero-content">
        <div class="hero-badge">
            🌍 Real-time Environmental Monitoring
        </div>
        <h1 class="hero-title">Peta Laporan Lingkungan</h1>
        <p class="hero-subtitle">
            Pantau dan lihat laporan masalah lingkungan dari komunitas secara real-time.
            Bersama-sama kita ciptakan lingkungan yang lebih bersih dan sehat.
        </p>
        <div class="hero-stats">
            <div class="stat-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <div class="stat-number">{{ count($reports) }}</div>
                    <div class="stat-label">Total Laporan</div>
                </div>
            </div>
            <div class="stat-item">
                <i class="fas fa-users"></i>
                <div>
                    <div class="stat-number">{{ collect($reports)->pluck('user.id')->unique()->count() }}</div>
                    <div class="stat-label">Kontributor Aktif</div>
                </div>
            </div>
            <div class="stat-item">
                <i class="fas fa-clock"></i>
                <div>
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Monitoring</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Container -->
<div class="map-container">
    <div class="map-header">
        <h3 class="map-title">
            <i class="fas fa-globe-americas"></i>
            Peta Interaktif
        </h3>
        <div class="map-controls">
            <button class="control-btn" id="locateBtn">
                <i class="fas fa-crosshairs"></i>
                Lokasi Saya
            </button>
            <button class="control-btn" id="refreshBtn">
                <i class="fas fa-sync-alt"></i>
                Refresh
            </button>
            <button class="control-btn" id="fullscreenBtn">
                <i class="fas fa-expand"></i>
                Fullscreen
            </button>
        </div>
    </div>

    <div id="map">
        <div class="map-loading" id="mapLoading">
            <div class="loading-content">
                <div class="loading-spinner"></div>
                <p>Memuat peta dan data laporan...</p>
            </div>
        </div>

        <!-- Map Legend -->
        <div class="map-legend">
            <div class="legend-title">
                <i class="fas fa-info-circle"></i>
                Keterangan
            </div>
            <div class="legend-item">
                <div class="legend-color user"></div>
                <span>Lokasi Anda</span>
            </div>
            <div class="legend-item">
                <div class="legend-color report"></div>
                <span>Laporan Masalah</span>
            </div>
            <div class="legend-item">
                <div class="legend-color resolved"></div>
                <span>Masalah Teratasi</span>
            </div>
        </div>

        <!-- Location Status -->
        <div class="location-status" id="locationStatus">
            <div class="location-icon inactive" id="locationIcon"></div>
            <span id="locationText">Mendeteksi lokasi...</span>
        </div>
    </div>
</div>

<!-- Action Section -->
<div class="action-section">
    <div class="action-icon">
        <i class="fas fa-plus"></i>
    </div>
    <h3 class="action-title">Laporkan Masalah Lingkungan</h3>
    <p class="action-subtitle">
        Temukan masalah lingkungan di sekitar Anda? Laporkan sekarang dan bantu komunitas untuk mengatasinya
        bersama-sama.
    </p>
    <a href="{{ route('reports.create') }}" class="action-btn">
        <i class="fas fa-exclamation-triangle"></i>
        Buat Laporan Baru
    </a>
</div>
@endsection

@push('scripts')
<script>
// Initialize map
var map = L.map('map');
var userMarker = null;
var userCircle = null;
var reportMarkers = [];

// Add tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Custom icons
var userIcon = L.divIcon({
    className: 'custom-div-icon',
    html: '<div style="background: #3b82f6; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"></div>',
    iconSize: [20, 20],
    iconAnchor: [10, 10]
});

var reportIcon = L.divIcon({
    className: 'custom-div-icon',
    html: '<div style="background: #ef4444; width: 16px; height: 16px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"></div>',
    iconSize: [16, 16],
    iconAnchor: [8, 8]
});

var resolvedIcon = L.divIcon({
    className: 'custom-div-icon',
    html: '<div style="background: #10b981; width: 16px; height: 16px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"></div>',
    iconSize: [16, 16],
    iconAnchor: [8, 8]
});

// Location found handler
function onLocationFound(e) {
    var radius = e.accuracy / 2;

    // Remove existing user marker and circle
    if (userMarker) map.removeLayer(userMarker);
    if (userCircle) map.removeLayer(userCircle);

    // Add new user marker and accuracy circle
    userMarker = L.marker(e.latlng, {
            icon: userIcon
        }).addTo(map)
        .bindPopup(
            '<div class="popup-title">📍 Lokasi Anda</div><div class="popup-description">Anda berada di sekitar area ini</div>'
            );

    userCircle = L.circle(e.latlng, {
        radius: radius,
        color: '#3b82f6',
        fillColor: '#3b82f6',
        fillOpacity: 0.1,
        weight: 2
    }).addTo(map);

    // Update location status
    updateLocationStatus(true, 'Lokasi terdeteksi');

    // Hide loading
    hideMapLoading();
}

// Location error handler
function onLocationError(e) {
    console.log('Location error:', e.message);
    // Set default view to Jakarta
    map.setView([-6.2088, 106.8456], 12);
    updateLocationStatus(false, 'Gagal mendeteksi lokasi');
    hideMapLoading();
}

// Update location status indicator
function updateLocationStatus(active, text) {
    const icon = document.getElementById('locationIcon');
    const textEl = document.getElementById('locationText');

    if (active) {
        icon.className = 'location-icon active';
    } else {
        icon.className = 'location-icon inactive';
    }

    textEl.textContent = text;
}

// Hide map loading
function hideMapLoading() {
    setTimeout(() => {
        document.getElementById('mapLoading').style.display = 'none';
    }, 1000);
}

// Add event listeners
map.on('locationfound', onLocationFound);
map.on('locationerror', onLocationError);

// Locate user
map.locate({
    setView: true,
    maxZoom: 16,
    timeout: 10000,
    enableHighAccuracy: true
});

// Add reports to map
const reports = @json($reports);

reports.forEach(report => {
    const icon = report.status === 'resolved' ? resolvedIcon : reportIcon;
    const statusColor = report.status === 'resolved' ? '#10b981' : '#ef4444';
    const statusText = report.status === 'resolved' ? 'Teratasi' : 'Belum Teratasi';

    const marker = L.marker([report.latitude, report.longitude], {
            icon: icon
        })
        .addTo(map)
        .bindPopup(`
            <div class="popup-title">${report.category}</div>
            <div class="popup-description">${report.description}</div>
            <div class="popup-meta">
                <strong>Status:</strong> <span style="color: ${statusColor};">${statusText}</span><br>
                <strong>Dilaporkan oleh:</strong> ${report.user.name}<br>
                <strong>Tanggal:</strong> ${new Date(report.created_at).toLocaleDateString('id-ID')}
            </div>
        `);

    reportMarkers.push(marker);
});

// Control buttons functionality
document.getElementById('locateBtn').addEventListener('click', function() {
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';
    updateLocationStatus(false, 'Mencari lokasi...');

    map.locate({
        setView: true,
        maxZoom: 16,
        timeout: 10000,
        enableHighAccuracy: true
    });

    setTimeout(() => {
        this.innerHTML = '<i class="fas fa-crosshairs"></i> Lokasi Saya';
    }, 2000);
});

document.getElementById('refreshBtn').addEventListener('click', function() {
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refresh';

    // Simulate refresh
    setTimeout(() => {
        location.reload();
    }, 1000);
});

document.getElementById('fullscreenBtn').addEventListener('click', function() {
    const mapContainer = document.querySelector('.map-container');

    if (!document.fullscreenElement) {
        mapContainer.requestFullscreen().then(() => {
            this.innerHTML = '<i class="fas fa-compress"></i> Exit Fullscreen';
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        });
    } else {
        document.exitFullscreen().then(() => {
            this.innerHTML = '<i class="fas fa-expand"></i> Fullscreen';
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        });
    }
});

// Handle fullscreen change
document.addEventListener('fullscreenchange', function() {
    const btn = document.getElementById('fullscreenBtn');
    if (!document.fullscreenElement) {
        btn.innerHTML = '<i class="fas fa-expand"></i> Fullscreen';
    }
});

// Auto-refresh reports every 30 seconds
setInterval(() => {
    if (document.visibilityState === 'visible') {
        // Fetch new reports data
        fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
                // Update stats in hero section
                const parser = new DOMParser();
                const newDoc = parser.parseFromString(html, 'text/html');
                const newStats = newDoc.querySelector('.hero-stats');
                const currentStats = document.querySelector('.hero-stats');
                if (newStats && currentStats) {
                    currentStats.innerHTML = newStats.innerHTML;
                }
            })
            .catch(console.error);
    }
}, 30000);

// Map resize handler
window.addEventListener('resize', function() {
    setTimeout(() => {
        map.invalidateSize();
    }, 100);
});
</script>
@endpush