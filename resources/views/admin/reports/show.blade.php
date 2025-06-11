@extends('layouts.app') {{-- Ganti 'layouts.app' dengan nama file layout utama Anda --}}

@section('title', 'Detail Laporan Lingkungan')

@section('content')
<div class="container">
    <h1>Detail Laporan: {{ $report->category }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lokasi Laporan</h5>
            {{-- Di sini Anda bisa menambahkan peta kecil untuk menunjukkan lokasi --}}
            <p><strong>Latitude:</strong> {{ $report->latitude }}</p>
            <p><strong>Longitude:</strong> {{ $report->longitude }}</p>

            <hr>

            <h5 class="card-title">Deskripsi</h5>
            <p>{{ $report->description }}</p>

            <h5 class="card-title">Status</h5>
            <p><span class="badge bg-secondary">{{ $report->status }}</span></p>

            <h5 class="card-title">Dilaporkan oleh</h5>
            <p>{{ $report->user->name }} pada {{ $report->created_at->format('d M Y H:i') }}</p>

            {{-- Tampilkan gambar jika ada --}}
            @if($report->image)
            <h5 class="card-title">Foto Laporan</h5>
            <img src="{{ asset('storage/' . $report->image) }}" alt="Foto Laporan" class="img-fluid"
                style="max-width: 500px;">
            @endif

            <a href="{{ route('reports.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Laporan</a>
        </div>
    </div>
</div>
@endsection