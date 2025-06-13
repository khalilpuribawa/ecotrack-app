@extends('layouts.app')

@section('title', 'Detail Tantangan: ' . $challenge->title)

@section('content')
<div class="container">
    {{-- Notifikasi Sukses/Error --}}
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Bagian Detail Informasi Tantangan --}}
            <h2 class="card-title">{{ $challenge->title }}</h2>
            <p class="lead text-muted">{{ $challenge->description }}</p>
            <hr>
            <p><strong>Periode:</strong>
                {{-- Disederhanakan karena kita sudah pakai $casts di Model --}}
                {{ $challenge->start_date->format('d M Y') }} sampai {{ $challenge->end_date->format('d M Y') }}
            </p>
            <p><strong>Hadiah Poin:</strong> <span class="badge bg-success fs-6">{{ $challenge->point_reward }}</span>
            </p>
            @if($challenge->badge)
            <p><strong>Badge Eksklusif:</strong> Dapatkan badge
                "{{ ucwords(str_replace('-', ' ', $challenge->badge)) }}"</p>
            @endif
        </div>

        <div class="card-footer bg-light p-4">
            {{-- ========================================================== --}}
            {{-- == BAGIAN INTERAKTIF BERDASARKAN STATUS PARTISIPASI      == --}}
            {{-- ========================================================== --}}

            @if($participation)
            {{-- >>> PENGGUNA SUDAH BERGABUNG <<< --}}

            @if ($participation->pivot->status == 'rejected')
            {{-- Status: Ditolak -> Tampilkan pesan error dan form lagi --}}
            <div class="alert alert-danger">
                <h4 class="alert-heading">Submission Ditolak</h4>
                <p>Maaf, bukti yang Anda kirimkan sebelumnya tidak valid. Silakan coba lagi.</p>
                @if($participation->pivot->admin_feedback)
                <hr>
                <p class="mb-0"><strong>Catatan dari Admin:</strong> {{ $participation->pivot->admin_feedback }}</p>
                @endif
            </div>
            @endif

            @if (in_array($participation->pivot->status, ['joined', 'rejected']))
            {{-- Status: Baru Bergabung atau Ditolak -> Tampilkan Form Upload --}}
            <h5>Upload Bukti Partisipasi</h5>
            <form action="{{ route('challenges.submitProof', $challenge->id) }}" method="POST"
                enctype="multipart/form-data" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="proof_image" class="form-label">Pilih Foto Bukti (Format: JPG, PNG. Maks: 2MB)</label>
                    <input class="form-control @error('proof_image') is-invalid @enderror" type="file" id="proof_image"
                        name="proof_image" required>
                    @error('proof_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit Bukti</button>
            </form>

            @elseif ($participation->pivot->status == 'submitted')
            {{-- Status: Sudah Submit -> Tampilkan Pesan Tunggu --}}
            <div class="alert alert-warning text-center">
                <h4 class="alert-heading">Menunggu Review</h4>
                <p>Bukti Anda sudah diterima dan sedang direview oleh admin. Terima kasih!</p>
                <p class="mb-0"><strong>Status:</strong> Menunggu Persetujuan</p>
            </div>

            @elseif ($participation->pivot->status == 'completed')
            {{-- Status: Selesai -> Tampilkan Pesan Selamat --}}
            <div class="alert alert-success text-center">
                <h4 class="alert-heading">🎉 Selamat! 🎉</h4>
                <p>Anda telah berhasil menyelesaikan tantangan ini. Poin dan badge (jika ada) telah ditambahkan ke akun
                    Anda.</p>
                <p class="mb-0"><strong>Status:</strong> Selesai</p>
            </div>
            @endif

            @else
            {{-- >>> PENGGUNA BELUM BERGABUNG <<< --}}
            <div class="text-center">
                <form action="{{ route('challenges.participate', $challenge) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-success">Ikuti Tantangan Ini!</button>
                </form>
            </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('challenges.index') }}" class="btn btn-secondary">Kembali ke Daftar Tantangan</a>
            </div>
        </div>
    </div>
</div>
@endsection