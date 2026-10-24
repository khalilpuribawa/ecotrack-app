@extends('admin.layouts.app')

@section('title', 'Green Spot Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Green Spot Management</h1>
        <div class="btn-group">
            <a href="{{ route('admin.green-points.index') }}" class="btn {{ !request('status') ? 'btn-secondary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.green-points.index', ['status' => 'unverified']) }}" class="btn {{ request('status') == 'unverified' ? 'btn-warning' : 'btn-outline-warning' }}">Unverified</a>
            <a href="{{ route('admin.green-points.index', ['status' => 'verified']) }}" class="btn {{ request('status') == 'verified' ? 'btn-success' : 'btn-outline-success' }}">Verified</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Added By</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($greenPoints as $point)
                            <tr>
                                <td><strong>#{{ $point->id }}</strong></td>
                                <td class="fw-semibold">{{ $point->name }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $point->type }}</span></td>
                                <td>{{ $point->addedBy->name }}</td>
                                <td>
                                    @if($point->verified)
                                        <span class="badge bg-success rounded-pill px-3 py-2">Verified</span>
                                    @else
                                        <span class="badge bg-warning rounded-pill px-3 py-2">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$point->verified)
                                        <form action="{{ route('admin.green-points.updateStatus', $point) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3 me-1">
                                                <i class="fas fa-check me-1"></i>Verify
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.green-points.destroy', $point) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this green spot?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No green spots found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($greenPoints->hasPages())
        <div class="card-footer bg-white border-0">
            {{ $greenPoints->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
@endsection
