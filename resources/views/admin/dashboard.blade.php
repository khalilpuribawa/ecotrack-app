@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['total_users'] }}</h5>
                    <p class="card-text">Total Pengguna</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['pending_reports'] }}</h5>
                    <p class="card-text">Laporan Menunggu Verifikasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['pending_green_points'] }}</h5>
                    <p class="card-text">Titik Hijau Menunggu Verifikasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['active_challenges'] }}</h5>
                    <p class="card-text">Tantangan Aktif</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan grafik atau tabel lain di sini -->
@endsection