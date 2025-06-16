@extends('layouts.app')

@section('title', 'Tambah Titik Hijau Baru - EcoTrack.ID')

@section('content')
<style>
.create-hero {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    border-radius: 20px;
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
}

.create-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M20 20c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10zm10 0c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    animation: float 25s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateX(0) translateY(0);
    }

    50% {
        transform: translateX(-25px) translateY(-25px);
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
    margin-bottom: 1rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.hero-steps {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.step-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1rem;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    font-size: 0.875rem;
}

.step-number {
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.75rem;
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
    border-color: #10b981;
    color: #059669;
}

.btn-map.active {
    background: #10b981;
    border-color: #10b981;
    color: white;
}

.map-container {
    position: relative;
    height: 450px;
    background: #f3f4f6;
}

#map-create {
    height: 450px;
    width: 100%;
    z-index: 1;
}

.map-instructions {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: white;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    max-width: 280px;
    font-size: 0.875rem;
    line-height: 1.4;
}

.instructions-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.coordinates-display {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    background: white;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    font-size: 0.875rem;
    font-family: monospace;
    min-width: 200px;
}

.coords-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.coords-value {
    color: #059669;
    font-weight: 500;
}

/* Form Section */
.form-section {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
}

.form-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.title-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label-modern {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.label-icon {
    width: 20px;
    height: 20px;
    background: #f3f4f6;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    color: #6b7280;
}

.form-control-modern {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-control-modern:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    background: white;
}

.form-control-modern.valid {
    border-color: #10b981;
    background: #f0fdf4;
}

.form-select-modern {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    background: #fafafa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.form-select-modern:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    background: white;
}

textarea.form-control-modern {
    resize: vertical;
    min-height: 100px;
    line-height: 1.5;
}

.coordinate-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.coordinate-input {
    position: relative;
}

.coordinate-input .form-control-modern {
    padding-right: 3rem;
}

.coordinate-icon {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    font-size: 0.875rem;
}

/* Submit Button */
.btn-submit {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-submit:hover::before {
    left: 100%;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.btn-submit:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-submit:disabled::before {
    display: none;
}

/* Validation Messages */
.validation-message {
    margin-top: 0.5rem;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.validation-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.validation-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.75rem;
    }

    .hero-steps {
        flex-direction: column;
        gap: 1rem;
    }

    .step-item {
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
    #map-create {
        height: 350px;
    }

    .map-instructions,
    .coordinates-display {
        position: relative;
        margin: 1rem;
        max-width: none;
    }

    .coordinate-row {
        grid-template-columns: 1fr;
    }

    .hero-content {
        padding: 2rem 1.5rem;
    }

    .form-section {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .map-controls {
        flex-direction: column;
    }

    .btn-map {
        width: 100%;
        justify-content: center;
    }
}
</style>

<!-- Hero Section -->
<div class="create-hero">
    <div class="hero-content">
        <div class="hero-badge">
            🌱 Kontribusi Komunitas
        </div>
        <h1 class="hero-title">Tambah Titik Hijau Baru</h1>
        <p class="hero-subtitle">
            Bantu komunitas dengan menambahkan lokasi ramah lingkungan yang Anda ketahui.
            Setiap kontribusi Anda akan membantu orang lain menemukan tempat-tempat hijau di sekitar mereka.
        </p>

        <div class="hero-steps">
            <div class="step-item">
                <div class="step-number">1</div>
                <span>Pilih lokasi di peta</span>
            </div>
            <div class="step-item">
                <div class="step-number">2</div>
                <span>Isi informasi detail</span>
            </div>
            <div class="step-item">
                <div class="step-number">3</div>
                <span>Submit kontribusi</span>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="map-section">
    <div class="map-header">
        <h2 class="map-title">
            <i class="fas fa-map"></i>
            Pilih Lokasi di Peta
        </h2>
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
            <div class="instructions-title">
                <i class="fas fa-info-circle"></i>
                Cara Menggunakan
            </div>
            <p>• Klik pada peta untuk menandai lokasi<br>
                • Atau gunakan tombol "Lokasi Saya"<br>
                • Koordinat akan terisi otomatis</p>
        </div>

        <div class="coordinates-display" id="coordsDisplay" style="display: none;">
            <div class="coords-title">Koordinat Terpilih:</div>
            <div class="coords-value" id="displayCoords">Belum dipilih</div>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="form-section">
    <h2 class="form-title">
        <div class="title-icon">
            <i class="fas fa-edit"></i>
        </div>
        Informasi Detail Lokasi
    </h2>

    <form action="{{ route('green-map.store') }}" method="POST" id="greenPointForm">
        @csrf

        <!-- Type Selection -->
        <div class="form-group">
            <label for="type" class="form-label-modern">
                <div class="label-icon">
                    <i class="fas fa-tag"></i>
                </div>
                Tipe Titik Hijau
            </label>
            <select name="type" id="type" class="form-select-modern" required>
                <option value="">Pilih tipe lokasi...</option>
                <option value="Bank Sampah" {{ old('type') == 'Bank Sampah' ? 'selected' : '' }}>🗑 Bank Sampah</option>
                <option value="Taman" {{ old('type') == 'Taman' ? 'selected' : '' }}>🌳 Taman Hijau</option>
                <option value="Tempat Daur Ulang" {{ old('type') == 'Tempat Daur Ulang' ? 'selected' : '' }}>♻ Tempat
                    Daur Ulang</option>
                <option value="Komunitas Hijau" {{ old('type') == 'Komunitas Hijau' ? 'selected' : '' }}>👥 Komunitas
                    Hijau</option>
                <option value="Lainnya" {{ old('type') == 'Lainnya' ? 'selected' : '' }}>📍 Lainnya</option>
            </select>
            <div class="validation-success" id="typeSuccess" style="display: none;">
                <i class="fas fa-check"></i>
                <span>Tipe sudah dipilih</span>
            </div>
        </div>

        <!-- Name Input -->
        <div class="form-group">
            <label for="name" class="form-label-modern">
                <div class="label-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                Nama Lokasi
            </label>
            <input type="text" name="name" id="name" class="form-control-modern" value="{{ old('name') }}"
                placeholder="Contoh: Bank Sampah Hijau Lestari" required>
            <div class="validation-message validation-success" id="nameSuccess" style="display: none;">
                <i class="fas fa-check"></i>
                <span>Nama lokasi sudah sesuai</span>
            </div>
        </div>

        <!-- Description Input -->
        <div class="form-group">
            <label for="description" class="form-label-modern">
                <div class="label-icon">
                    <i class="fas fa-align-left"></i>
                </div>
                Deskripsi Singkat
            </label>
            <textarea name="description" id="description" rows="4" class="form-control-modern"
                placeholder="Jelaskan secara singkat tentang lokasi ini, fasilitas yang tersedia, jam operasional, dll."
                required>{{ old('description') }}</textarea>
            <div class="validation-message validation-success" id="descSuccess" style="display: none;">
                <i class="fas fa-check"></i>
                <span>Deskripsi sudah memadai</span>
            </div>
        </div>

        <!-- Coordinates -->
        <div class="form-group">
            <label class="form-label-modern">
                <div class="label-icon">
                    <i class="fas fa-crosshairs"></i>
                </div>
                Koordinat Lokasi
            </label>
            <div class="coordinate-row">
                <div class="coordinate-input">
                    <input type="text" name="latitude" id="latitude" class="form-control-modern"
                        value="{{ old('latitude') }}" placeholder="Latitude" required readonly>
                    <div class="coordinate-icon">LAT</div>
                </div>
                <div class="coordinate-input">
                    <input type="text" name="longitude" id="longitude" class="form-control-modern"
                        value="{{ old('longitude') }}" placeholder="Longitude" required readonly>
                    <div class="coordinate-icon">LNG</div>
                </div>
            </div>
            <div class="validation-message validation-error" id="coordsError" style="display: none;">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Silakan pilih lokasi di peta terlebih dahulu</span>
            </div>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn" disabled>
            <i class="fas fa-plus-circle"></i>
            <span id="submitText">Pilih Lokasi di Peta Terlebih Dahulu</span>
        </button>
    </form>
</div>

<script>
// Wait for page to fully load
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(initializeMap, 100);
    initializeForm();
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

        // Style inputs as valid
        latInput.classList.add('valid');
        lonInput.classList.add('valid');

        // Validate form
        validateForm();
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

        latInput.classList.remove('valid');
        lonInput.classList.remove('valid');

        validateForm();
    });

    // Ensure map renders properly
    setTimeout(function() {
        map.invalidateSize();
    }, 500);
}

function initializeForm() {
    // Form validation
    const typeSelect = document.getElementById('type');
    const nameInput = document.getElementById('name');
    const descInput = document.getElementById('description');
    const typeSuccess = document.getElementById('typeSuccess');
    const nameSuccess = document.getElementById('nameSuccess');
    const descSuccess = document.getElementById('descSuccess');

    typeSelect.addEventListener('change', function() {
        if (this.value) {
            this.classList.add('valid');
            typeSuccess.style.display = 'flex';
        } else {
            this.classList.remove('valid');
            typeSuccess.style.display = 'none';
        }
        validateForm();
    });

    nameInput.addEventListener('input', function() {
        if (this.value.trim().length >= 3) {
            this.classList.add('valid');
            nameSuccess.style.display = 'flex';
        } else {
            this.classList.remove('valid');
            nameSuccess.style.display = 'none';
        }
        validateForm();
    });

    descInput.addEventListener('input', function() {
        if (this.value.trim().length >= 10) {
            this.classList.add('valid');
            descSuccess.style.display = 'flex';
        } else {
            this.classList.remove('valid');
            descSuccess.style.display = 'none';
        }
        validateForm();
    });

    // Form submission - SIMPLIFIED
    const form = document.getElementById('greenPointForm');
    form.addEventListener('submit', function(e) {
        // Don't prevent default - let form submit normally
        if (!validateForm()) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
            return false;
        }

        // Show loading state
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambahkan Titik Hijau...';

        // Let form submit naturally
        return true;
    });
}

function validateForm() {
    const type = document.getElementById('type').value;
    const name = document.getElementById('name').value.trim();
    const description = document.getElementById('description').value.trim();
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;

    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const coordsError = document.getElementById('coordsError');

    const hasCoordinates = lat && lng;
    const isValid = type && name.length >= 3 && description.length >= 10 && hasCoordinates;

    if (!hasCoordinates) {
        coordsError.style.display = 'flex';
    } else {
        coordsError.style.display = 'none';
    }

    submitBtn.disabled = !isValid;

    if (isValid) {
        submitText.textContent = 'Tambahkan Titik Hijau';
        submitBtn.innerHTML = '<i class="fas fa-plus-circle"></i> ' + submitText.textContent;
    } else if (!hasCoordinates) {
        submitText.textContent = 'Pilih Lokasi di Peta Terlebih Dahulu';
        submitBtn.innerHTML = '<i class="fas fa-map-marker-alt"></i> ' + submitText.textContent;
    } else {
        submitText.textContent = 'Lengkapi Semua Field';
        submitBtn.innerHTML = '<i class="fas fa-edit"></i> ' + submitText.textContent;
    }

    return isValid;
}

// Initial validation
validateForm();
</script>
@endsection