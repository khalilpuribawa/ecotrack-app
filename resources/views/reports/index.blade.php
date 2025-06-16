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
// Inisialisasi peta tanpa setView awal, kita akan mengaturnya nanti.
var map = L.map('map');

// Tambahkan layer peta dari OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

// --- LOGIKA BARU UNTUK DETEKSI LOKASI ---

// 1. Event handler jika lokasi BERHASIL ditemukan
function onLocationFound(e) {
    var radius = e.accuracy / 2;
    L.marker(e.latlng).addTo(map)
        .bindPopup("Anda berada di sekitar sini").openPopup();
    L.circle(e.latlng, radius).addTo(map);
}

// 2. Event handler jika lokasi GAGAL ditemukan (misal: user menolak izin)
function onLocationError(e) {
    alert("Gagal mendeteksi lokasi Anda. Menampilkan peta Jakarta.");
    // Atur ke lokasi default (Jakarta) jika gagal
    map.setView([-6.2088, 106.8456], 12);
}

// Tambahkan event listener ke peta
map.on('locationfound', onLocationFound);
map.on('locationerror', onLocationError);

// 3. Panggil fungsi untuk mendeteksi lokasi pengguna
// setView: true -> otomatis mengatur pusat peta ke lokasi yang ditemukan
// maxZoom: 16 -> level zoom saat lokasi ditemukan
map.locate({
    setView: true,
    maxZoom: 16
});


// --- KODE LAMA ANDA UNTUK MENAMPILKAN MARKER LAPORAN (TETAP DIPAKAI) ---
const reports = @json($reports);

reports.forEach(report => {
    L.marker([report.latitude, report.longitude])
        .addTo(map)
        .bindPopup(
            `<b>${report.category}</b><br>${report.description}<br><small>Dilaporkan oleh: ${report.user.name}</small>`
            );
});
</script>
@endpush