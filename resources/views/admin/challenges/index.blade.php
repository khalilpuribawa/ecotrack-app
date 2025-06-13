@extends('admin.layouts.app')

@section('title', 'Manajemen Tantangan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Manajemen Tantangan</h1>
    <a href="{{ route('admin.challenges.create') }}" class="btn btn-primary">Buat Tantangan Baru</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Poin</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($challenges as $challenge)
                <tr>
                    <td>{{ $challenge->id }}</td>
                    <td>{{ $challenge->title }}</td>
                    <td>{{ $challenge->point_reward }}</td>
                    <td>{{ \Carbon\Carbon::parse($challenge->start_date)->format('d M') }} -
                        {{ \Carbon\Carbon::parse($challenge->end_date)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.challenges.edit', $challenge) }}"
                            class="btn btn-sm btn-warning">Edit</a>
                        {{-- Di dalam loop foreach, di dalam <td> Aksi --}}
                        <a href="{{ route('admin.challenges.review', $challenge->id) }}"
                            class="btn btn-sm btn-info">Review</a>
                        <form action="{{ route('admin.challenges.destroy', $challenge) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tantangan ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada tantangan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $challenges->links() }}</div>
</div>
@endsection