@extends('admin.layouts.app')

@section('title', 'Manajemen Laporan')

@section('content')
<h1 class="mb-4">Manajemen Laporan</h1>

<div class="btn-group mb-3">
    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">Semua</a>
    <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}" class="btn btn-warning">Pending</a>
    <a href="{{ route('admin.reports.index', ['status' => 'verified']) }}" class="btn btn-info">Verified</a>
    <a href="{{ route('admin.reports.index', ['status' => 'resolved']) }}" class="btn btn-success">Resolved</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Pelapor</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->category }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td><span
                            class="badge bg-{{ $report->status == 'pending' ? 'warning' : ($report->status == 'verified' ? 'info' : 'success') }}">{{ $report->status }}</span>
                    </td>
                    <td>{{ $report->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.reports.show', $report) }}"
                                        target="_blank">Lihat Detail</a></li>
                                @if($report->status == 'pending')
                                <li>
                                    <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="verified">
                                        <button type="submit" class="dropdown-item">Verifikasi</button>
                                    </form>
                                </li>
                                @endif
                                @if($report->status == 'verified')
                                <li>
                                    <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="resolved">
                                        <button type="submit" class="dropdown-item">Tandai Selesai</button>
                                    </form>
                                </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('admin.reports.destroy', $report) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data laporan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $reports->appends(request()->query())->links() }}
    </div>
</div>
@endsection