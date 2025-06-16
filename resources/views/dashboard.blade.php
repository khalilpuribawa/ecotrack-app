@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        {{-- BENAR --}}
        <h1>Selamat Datang, {{ $user->name }}!</h1>
        <p>Poin Anda saat ini: <strong>{{ $user->points }}</strong>. Teruslah berkontribusi untuk bumi yang lebih
            baik.</p>
        <a href="{{ route('reports.create') }}" class="btn btn-success btn-lg">Lapor Masalah Lingkungan</a>
        <a href="{{ route('challenges.index') }}" class="btn btn-primary btn-lg">Lihat Tantangan</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h3>Laporan Terakhir Anda</h3>
        @forelse ($myReports as $report)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $report->category }}</h5>
                <p class="card-text">{{ Str::limit($report->description, 100) }}</p>
                <span class="badge bg-info">{{ $report->status }}</span>
            </div>
        </div>
        @empty
        <p>Anda belum membuat laporan.</p>
        @endforelse
    </div>
    <div class="col-md-6">
        <h3>Tantangan Aktif</h3>
        @forelse ($activeChallenges as $challenge)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $challenge->title }}</h5>
                <p class="card-text">Dapatkan {{ $challenge->point_reward }} poin!</p>
                <a href="{{ route('challenges.show', $challenge) }}" class="btn btn-sm btn-outline-success">Lihat
                    Detail</a>
            </div>
        </div>
        @empty
        <p>Tidak ada tantangan aktif saat ini.</p>
        @endforelse
    </div>
</div>
@endsection