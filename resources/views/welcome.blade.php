@extends('layouts.app')

@section('title', 'EcoTrack.ID - Jejak Aksi Hijaumu, Dampak untuk Bumi')

@section('content')
    <div class="container text-center py-5">
        <div class="p-5 mb-4 bg-success-subtle rounded-3 shadow-sm">
            <div class="container-fluid py-5">
                <h1 class="display-3 fw-bold">🌱 EcoTrack.ID</h1>
                <p class="fs-4 fst-italic">"Jejak Aksi Hijaumu, Dampak untuk Bumi."</p>
                <p class="col-md-8 mx-auto lead mt-4">
                    Platform kolaboratif untuk memantau, melaporkan, dan bertindak demi lingkungan yang lebih baik. Bergabunglah dengan ribuan pahlawan hijau lainnya!
                </p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg mt-3">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg mt-3">Masuk</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg mt-3">Buka Dashboard</a>
                @endguest
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title">🚨 Lapor Lingkungan</h3>
                        <p class="card-text">Temukan tumpukan sampah atau penebangan liar? Laporkan langsung dari lokasi Anda dan biarkan komunitas serta instansi terkait menindaklanjuti.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title">🏆 Eco-Challenge</h3>
                        <p class="card-text">Ikuti tantangan hijau mingguan, seperti mengurangi plastik atau menanam pohon. Kumpulkan poin, raih badge, dan jadilah juara lingkungan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title">🗺️ Peta Hijau</h3>
                        <p class="card-text">Temukan lokasi bank sampah, tempat daur ulang, dan taman kota terdekat. Tambahkan titik hijau baru untuk membantu orang lain.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection