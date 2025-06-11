@extends('admin.layouts.app')

@section('title', 'Manajemen Titik Hijau')

@section('content')
    <h1 class="mb-4">Manajemen Titik Hijau</h1>

    <div class="btn-group mb-3">
        <a href="{{ route('admin.green-points.index') }}" class="btn btn-secondary">Semua</a>
        <a href="{{ route('admin.green-points.index', ['status' => 'unverified']) }}" class="btn btn-warning">Belum
            Diverifikasi</a>
        <a href="{{ route('admin.green-points.index', ['status' => 'verified']) }}" class="btn btn-success">Sudah
            Diverifikasi</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Ditambahkan Oleh</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($greenPoints as $point)
                        <tr>
                            <td>{{ $point->id }}</td>
                            <td>{{ $point->name }}</td>
                            <td>{{ $point->type }}</td>
                            <td>{{ $point->addedBy->name }}</td>
                            <td>
                                @if($point->verified)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if(!$point->verified)
                                    <form action="{{ route('admin.green-points.updateStatus', $point) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-sm btn-success">Verifikasi</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.green-points.destroy', $point) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus titik ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data titik hijau.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $greenPoints->appends(request()->query())->links() }}
        </div>
    </div>
@endsection