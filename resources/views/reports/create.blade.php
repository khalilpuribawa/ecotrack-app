@extends('layouts.app')

@section('title', 'Buat Laporan Baru')

@section('content')
    <h1>Buat Laporan Lingkungan</h1>
    <p>Gunakan peta untuk menandai lokasi atau isi koordinat secara manual.</p>

    <div id="map-create" style="height: 300px; margin-bottom: 20px;"></div>

    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Kategori Laporan</label>
            <select name="category" id="category" class="form-select" required>
                <option value="Sampah menumpuk">Sampah Menumpuk</option>
                <option value="Kebakaran lahan">Kebakaran Lahan</option>
                <option value="Polusi udara/air">Polusi Udara/Air</option>
                <option value="Penebangan pohon liar">Penebangan Pohon Liar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="form-control"
                required>{{ old('description') }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Foto Bukti (Opsional, max 2MB)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Kirim Laporan</button>
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