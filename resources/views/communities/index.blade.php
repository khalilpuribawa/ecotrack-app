@extends('layouts.app')

@section('title', 'Daftar Komunitas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Komunitas Hijau</h1>
        <a href="{{ route('communities.create') }}" class="btn btn-success">Buat Komunitas Baru</a>
    </div>
    <p>Temukan grup, diskusikan ide, dan berkolaborasi dalam aksi nyata.</p>

    @forelse ($communities as $community)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">{{ $community->name }}</h4>
                    <p class="card-text">{{ Str::limit($community->description, 150) }}</p>
                    <small class="text-muted">
                        Dibuat oleh: {{ $community->creator->name }} | {{ $community->members_count }} Anggota
                    </small>
                </div>
                <div>
                    <a href="{{ route('communities.show', $community) }}" class="btn btn-primary">Lihat & Bergabung</a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada komunitas yang dibuat. Jadilah yang pertama!</div>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $communities->links() }}
    </div>
@endsection