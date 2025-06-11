@extends('layouts.app')

@section('title', 'Eco-Challenge Mingguan')

@section('content')
    <h1 class="mb-4">Tantangan Hijau Tersedia</h1>
    <p>Ikuti tantangan, kumpulkan poin, dan buktikan kepedulianmu terhadap lingkungan!</p>

    @forelse ($challenges as $challenge)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title">{{ $challenge->title }}</h4>
                        <p class="card-text">{{ Str::limit($challenge->description, 150) }}</p>
                        <p class="card-text">
                            <small class="text-muted">
                                Periode: {{ \Carbon\Carbon::parse($challenge->start_date)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($challenge->end_date)->format('d M Y') }}
                            </small>
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <span class="badge bg-success fs-5">{{ $challenge->point_reward }} Poin</span>
                        <br><br>
                        <a href="{{ route('challenges.show', $challenge) }}" class="btn btn-primary">Lihat Detail & Ikuti</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Saat ini tidak ada tantangan yang tersedia. Cek kembali nanti!
        </div>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $challenges->links() }}
    </div>
@endsection