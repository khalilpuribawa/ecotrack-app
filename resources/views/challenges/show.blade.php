@extends('layouts.app')

@section('title', $challenge->title)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $challenge->title }}</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <p class="lead">{{ $challenge->description }}</p>
            <hr>
            <p><strong>Periode:</strong> {{ \Carbon\Carbon::parse($challenge->start_date)->format('d M Y') }} sampai
                {{ \Carbon\Carbon::parse($challenge->end_date)->format('d M Y') }}</p>
            <p><strong>Hadiah Poin:</strong> <span class="badge bg-success fs-6">{{ $challenge->point_reward }}</span></p>
            @if($challenge->badge)
                <p><strong>Badge Eksklusif:</strong> Dapatkan badge "{{ ucwords(str_replace('-', ' ', $challenge->badge)) }}"
                </p>
            @endif
        </div>
        <div class="card-footer text-center">
            @if($participation)
                <div class="alert alert-info">
                    Anda sudah bergabung dengan tantangan ini.
                    <br>
                    <strong>Status:</strong> {{ ucfirst($participation->pivot->status) }}
                    {{-- Di sini bisa ditambahkan tombol untuk upload bukti jika statusnya 'joined' --}}
                </div>
            @else
                <form action="{{ route('challenges.participate', $challenge) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-success">Ikuti Tantangan Ini!</button>
                </form>
            @endif
            <a href="{{ route('challenges.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Tantangan</a>
        </div>
    </div>
@endsection