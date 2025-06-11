@extends('layouts.app')

@section('title', 'Peta Laporan Lingkungan')

@section('content')
    <h1>Peta Laporan Lingkungan</h1>
    <p>Lihat laporan masalah lingkungan dari komunitas secara real-time.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="map" style="height: 500px;" class="mb-4"></div>

    <a href="{{ route('reports.create') }}" class="btn btn-primary">Buat Laporan Baru</a>
@endsection

@push('scripts')
    <script>
        // Inisialisasi peta di Jakarta
        var map = L.map('map').setView([-6.2088, 106.8456], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Ambil data laporan dari PHP dan tampilkan sebagai marker
        const reports = @json($reports);

        reports.forEach(report => {
            L.marker([report.latitude, report.longitude])
                .addTo(map)
                .bindPopup(`<b>${report.category}</b><br>${report.description}<br><small>Dilaporkan oleh: ${report.user.name}</small>`);
        });
    </script>
@endpush