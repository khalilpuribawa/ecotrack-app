@extends('layouts.app')

@section('title', 'Buat Laporan Baru - EcoTrack.ID')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    border-radius: 16px;
    color: white;
    padding: 2rem;
    margin-bottom: 2rem;
    text-align: center;
}

.hero-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Map Container */
.map-section {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
    overflow: hidden;
}

.map-header {
    background: #f8fafc;
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.map-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.map-controls {
    display: flex;
    gap: 0.75rem;
}

.btn-map {
    padding: 0.5rem 1rem;
    border: 1px solid #d1d5db;
    background: white;
    color: #374151;
    border-radius: 8px;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-map:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
}

.btn-map.active {
    background: #10b981;
    border-color: #10b981;
    color: white;
}

/* Map Styling - SIMPLIFIED */
.map-container {
    position: relative;
    height: 400px;
    background: #f3f4f6;
}

#map-create {
    height: 400px;
    width: 100%;
    z-index: 1;
}

.map-instructions {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-width: 250px;
    font-size: 0.875rem;
    line-height: 1.4;
}

.coordinates-display {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    background: white;
    padding: 0.75rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    font-size: 0.875rem;
    font-family: monospace;
}

/* Form Styling */
.form-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.form-select {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    background: white;
    transition: border-color 0.3s ease;
}

.form-select:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.coordinate-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.btn-submit {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
}

.btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-submit:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.alert {
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    font-size: 0.875rem;
}

.alert-danger {
    background: #fee2e2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.5rem;
    }

    .map-header {
        flex-direction: column;
        align-items: stretch;
    }

    .map-controls {
        justify-content: center;
    }

    .map-container {
        height: 300px;
    }

    #map-create {
        height: 300px;
    }

    .coordinate-row {
        grid-template-columns: 1fr;
    }

    .map-instructions,
    .coordinates-display {
        position: relative;
        margin: 1rem;
        max-width: none;
    }
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <h1 class="hero-title">🚨 Buat Laporan Lingkungan</h1>
    <p class="hero-subtitle">Laporkan masalah lingkungan di sekitar Anda untuk membantu komunitas</p>
</div>

<!-- Map Section -->
<div class="map-section">
    <div class="map-header">
        <h3 class="map-title">
            <i class="fas fa-map-marker-alt"></i>
            Pilih Lokasi Masalah
        </h3>
        <div class="map-controls">
            <button class="btn-map" id="locateBtn">
                <i class="fas fa-crosshairs"></i>
                Lokasi Saya
            </button>
            <button class="btn-map" id="clearBtn">
                <i class="fas fa-times"></i>
                Hapus Marker
            </button>
        </div>
    </div>

    <div class="map-container">
        <div id="map-create"></div>

        <div class="map-instructions">
            <strong>📍 Cara Menggunakan:</strong><br>
            • Klik pada peta untuk menandai lokasi<br>
            • Atau gunakan tombol "Lokasi Saya"<br>
            • Koordinat akan terisi otomatis
        </div>

        <div class="coordinates-display" id="coordsDisplay" style="display: none;">
            <strong>Koordinat Terpilih:</strong><br>
            <span id="displayCoords">Belum dipilih</span>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="form-section">
    <h2 class="form-title">
        <i class="fas fa-edit"></i>
        Detail Laporan
    </h2>

    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" id="reportForm">
        @csrf

        <div class="form-group">
            <label for="category" class="form-label">
                <i class="fas fa-tag"></i> Kategori Laporan
            </label>
            <select name="category" id="category" class="form-select" required>
                <option value="">Pilih kategori masalah...</option>
                <option value="Sampah menumpuk">🗑 Sampah Menumpuk</option>
                <option value="Kebakaran lahan">🔥 Kebakaran Lahan</option>
                <option value="Polusi udara/air">💨 Polusi Udara/Air</option>
                <option value="Penebangan pohon liar">🌳 Penebangan Pohon Liar</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">
                <i class="fas fa-align-left"></i> Deskripsi Masalah
            </label>
            <textarea name="description" id="description" class="form-control"
                placeholder="Jelaskan masalah lingkungan yang Anda temukan secara detail..."
                required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-map-pin"></i> Koordinat Lokasi
            </label>
            <div class="coordinate-row">
                <div>
                    <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude"
                        required readonly>
                </div>
                <div>
                    <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude"
                        required readonly>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">
                <i class="fas fa-camera"></i> Foto Bukti (Opsional, max 2MB)
            </label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn-submit" id="submitBtn" disabled>
            <i class="fas fa-paper-plane"></i>
            <span id="submitText">Pilih Lokasi Terlebih Dahulu</span>
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Wait for page to fully load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map with a slight delay to ensure Leaflet is loaded
    setTimeout(initializeMap, 100);
});

function initializeMap() {
    // Check if Leaflet is loaded
    if (typeof L === 'undefined') {
        console.error('Leaflet not loaded');
        return;
    }

    // Initialize map
    var map = L.map('map-create').setView([-6.2088, 106.8456], 12);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Variables
    var marker;
    var latInput = document.getElementById('latitude');
    var lonInput = document.getElementById('longitude');
    var coordsDisplay = document.getElementById('coordsDisplay');
    var displayCoords = document.getElementById('displayCoords');
    var submitBtn = document.getElementById('submitBtn');
    var submitText = document.getElementById('submitText');

    // Place marker function
    function placeMarkerAndSetInputs(latlng) {
        // Remove existing marker
        if (marker) {
            map.removeLayer(marker);
        }

        // Add new marker
        marker = L.marker(latlng).addTo(map);

        // Update inputs
        latInput.value = latlng.lat.toFixed(6);
        lonInput.value = latlng.lng.toFixed(6);

        // Show coordinates
        coordsDisplay.style.display = 'block';
        displayCoords.textContent = latlng.lat.toFixed(6) + ', ' + latlng.lng.toFixed(6);

        // Enable submit button
        submitBtn.disabled = false;
        submitText.textContent = 'Kirim Laporan';

        // Style inputs as valid
        latInput.style.borderColor = '#10b981';
        lonInput.style.borderColor = '#10b981';
    }

    // Location handlers
    function onLocationFound(e) {
        placeMarkerAndSetInputs(e.latlng);
        map.setView(e.latlng, 16);
    }

    function onLocationError(e) {
        console.log('Location error:', e.message);
        alert('Tidak dapat mendeteksi lokasi Anda. Silakan klik pada peta untuk memilih lokasi.');
    }

    // Map events
    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);

    // Click on map to place marker
    map.on('click', function(e) {
        placeMarkerAndSetInputs(e.latlng);
    });

    // Control buttons
    document.getElementById('locateBtn').addEventListener('click', function() {
        var btn = this;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';
        btn.classList.add('active');

        map.locate({
            setView: true,
            maxZoom: 16,
            timeout: 10000,
            enableHighAccuracy: true
        });

        setTimeout(function() {
            btn.innerHTML = '<i class="fas fa-crosshairs"></i> Lokasi Saya';
            btn.classList.remove('active');
        }, 3000);
    });

    document.getElementById('clearBtn').addEventListener('click', function() {
        if (marker) {
            map.removeLayer(marker);
            marker = null;
        }

        latInput.value = '';
        lonInput.value = '';
        coordsDisplay.style.display = 'none';

        submitBtn.disabled = true;
        submitText.textContent = 'Pilih Lokasi Terlebih Dahulu';

        latInput.style.borderColor = '#e5e7eb';
        lonInput.style.borderColor = '#e5e7eb';
    });

    // Form validation
    var form = document.getElementById('reportForm');
    var categorySelect = document.getElementById('category');
    var descriptionTextarea = document.getElementById('description');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        var isValid = true;
        var errors = [];

        if (!latInput.value || !lonInput.value) {
            errors.push('Pilih lokasi pada peta');
            isValid = false;
        }

        if (!categorySelect.value) {
            errors.push('Pilih kategori laporan');
            categorySelect.style.borderColor = '#dc2626';
            isValid = false;
        }

        if (descriptionTextarea.value.trim().length < 10) {
            errors.push('Deskripsi minimal 10 karakter');
            descriptionTextarea.style.borderColor = '#dc2626';
            isValid = false;
        }

        if (!isValid) {
            alert('Error:\n' + errors.join('\n'));
            return;
        }

        // Show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim Laporan...';

        // Submit form
        setTimeout(function() {
            form.submit();
        }, 1000);
    });

    // Input validation styling
    categorySelect.addEventListener('change', function() {
        if (this.value) {
            this.style.borderColor = '#10b981';
        }
    });

    descriptionTextarea.addEventListener('input', function() {
        if (this.value.trim().length >= 10) {
            this.style.borderColor = '#10b981';
        }
    });

    // Try to get user location on load
    map.locate();

    // Ensure map renders properly
    setTimeout(function() {
        map.invalidateSize();
    }, 500);
}
</script>
@endpush