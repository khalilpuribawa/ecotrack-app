{{-- Mengasumsikan Anda menggunakan layout utama, misalnya app.blade.php --}}
@extends('layouts.app') {{-- Ganti dengan nama file layout Anda --}}

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Tantangan: {{ $challenge->title }}</h6>
        </div>
        <div class="card-body">

            {{-- Form ini akan mengirim data ke method 'update' --}}
            <form action="{{ route('admin.challenges.update', $challenge->id) }}" method="POST">
                @csrf {{-- Wajib untuk keamanan --}}
                @method('PUT') {{-- Wajib untuk memberitahu Laravel ini adalah metode UPDATE --}}

                {{-- Field untuk Judul --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $challenge->title) }}" required>
                </div>

                {{-- Field untuk Deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4"
                        required>{{ old('description', $challenge->description) }}</textarea>
                </div>

                {{-- Field untuk Poin --}}
                <div class="mb-3">
                    <label for="points" class="form-label">Poin</label>
                    <input type="number" class="form-control" id="points" name="points"
                        value="{{ old('points', $challenge->points) }}" required>
                </div>

                {{-- Field untuk Tanggal Mulai dan Selesai --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ old('start_date', $challenge->start_date->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ old('end_date', $challenge->end_date->format('Y-m-d')) }}" required>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.challenges.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection