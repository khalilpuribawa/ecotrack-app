{{-- resources/views/admin/challenges/edit.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'Edit Tantangan: ' . $challenge->title)

@section('content')
<h1 class="mb-4">Edit Tantangan</h1>

<div class="card">
    <div class="card-body">
        {{-- PENTING: Arahkan ke rute update dan gunakan method PUT/PATCH --}}
        <form action="{{ route('admin.challenges.update', $challenge->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Atau PATCH, sesuaikan dengan rute Anda --}}

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Judul Tantangan</label>
                {{-- PENTING: Isi value dengan data lama atau data dari database --}}
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $challenge->title) }}" required>
                {{-- INI YANG AKAN MENAMPILKAN PESAN ERROR --}}
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" rows="4" required>{{ old('description', $challenge->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Point Reward --}}
            <div class="mb-3">
                <label for="point_reward" class="form-label">Hadiah Poin</label>
                <input type="number" class="form-control @error('point_reward') is-invalid @enderror" id="point_reward"
                    name="point_reward" value="{{ old('point_reward', $challenge->point_reward) }}" required>
                @error('point_reward')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Start & End Date --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                        name="start_date" value="{{ old('start_date', $challenge->start_date->format('Y-m-d')) }}"
                        required>
                    @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                        name="end_date" value="{{ old('end_date', $challenge->end_date->format('Y-m-d')) }}" required>
                    @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Badge --}}
            <div class="mb-3">
                <label for="badge" class="form-label">Badge (Opsional)</label>
                <input type="text" class="form-control @error('badge') is-invalid @enderror" id="badge" name="badge"
                    value="{{ old('badge', $challenge->badge) }}">
                @error('badge')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Tantangan</button>
            <a href="{{ route('admin.challenges.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection