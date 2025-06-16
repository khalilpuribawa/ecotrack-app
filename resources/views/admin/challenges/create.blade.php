@extends('admin.layouts.app') {{-- Sesuaikan dengan layout admin Anda --}}
@section('title', 'Buat Tantangan Baru')

@section('content')
<div class="container">
    <h1 class="h3 mb-4">Buat Tantangan Baru</h1>

    <div class="card shadow">
        <div class="card-body">

            {{-- Tampilkan error validasi jika ada --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.challenges.store') }}" method="POST">
                @csrf

                {{-- Judul Tantangan --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Tantangan</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="5"
                        required>{{ old('description') }}</textarea>
                </div>

                {{-- Hadiah Poin --}}
                <div class="mb-3">
                    <label for="point_reward" class="form-label">Hadiah Poin</label>
                    <input type="number" class="form-control" id="point_reward" name="point_reward"
                        value="{{ old('point_reward') }}" required>
                </div>

                {{-- Periode --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ old('start_date') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ old('end_date') }}" required>
                    </div>
                </div>

                {{-- Badge (Opsional) --}}
                <div class="mb-3">
                    <label for="badge" class="form-label">Nama Badge (Opsional)</label>
                    <input type="text" class="form-control" id="badge" name="badge" value="{{ old('badge') }}"
                        placeholder="Contoh: no-straw-hero">
                    <small class="form-text text-muted">Gunakan format slug (huruf kecil, tanpa spasi, gunakan strip).
                        Contoh: 'pejuang-tanpa-plastik'.</small>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">Simpan Tantangan</button>
                <a href="{{ route('admin.challenges.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection