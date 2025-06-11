@extends('layouts.app')

@section('title', 'Peta Hijau Komunitas')

@section('content')
    <h1>Peta Hijau Komunitas</h1>
    <p>Temukan dan bagikan lokasi-lokasi ramah lingkungan seperti Bank Sampah, Taman, dan lainnya.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="map" style="height: 500px;" class="mb-4"></div>

    <a href="{{ route('green-map.create') }}" class="btn btn-primary">Tambah Titik Hijau Baru</a>
@endsection

@push('scripts')
    <script>
        var map = L.map('map').setView([-6.2088, 106.8456], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const greenPoints = @json($greenPoints);

        greenPoints.forEach(point => {
            L.marker([point.latitude, point.longitude])
                .addTo(map)
                .bindPopup(`<b>${point.name}</b><br><i>Kategori: ${point.type}</i><br>${point.description}`);
        });
    </script>
@endpush