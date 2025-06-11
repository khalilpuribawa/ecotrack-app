@extends('layouts.app')

@section('title', 'Tambah Titik Hijau Baru')

@section('content')
    <h1>Tambah Titik Hijau Komunitas</h1>
    <p>Pilih lokasi di peta untuk mengisi koordinat secara otomatis.</p>

    <div id="map-create" style="height: 300px; margin-bottom: 20px;"></div>

    <form action="{{ route('green-map.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Tipe Titik Hijau</label>
            <select name="type" id="type" class="form-select" required>
                <option value="Bank Sampah">Bank Sampah</option>
                <option value="Taman Kota">Taman Kota</option>
                <option value="Tempat Daur Ulang">Tempat Daur Ulang</option>
                <option value="Komunitas Hijau Lokal">Komunitas Hijau Lokal</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lokasi</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Singkat</label>
            <textarea name="description" id="description" rows="3" class="form-control"
                required>{{ old('description') }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}"
                    required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude') }}"
                    required>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Tambahkan Titik Hijau</button>
    </form>
@endsection

@push('scripts')
    <script>
        var map = L.map('map-create').setView([-6.2088, 106.8456], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var marker;

        map.on('click', function (e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
        });
    </script>
@endpush