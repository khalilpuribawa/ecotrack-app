@extends('admin.layouts.app')

@section('title', 'Challenge Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold">Challenge Management</h1>
    <a href="{{ route('admin.challenges.create') }}" class="btn btn-success rounded-pill px-4">
        <i class="fas fa-plus me-1"></i>Create New Challenge
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Points</th>
                        <th>Period</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($challenges as $challenge)
                    <tr>
                        <td><strong>#{{ $challenge->id }}</strong></td>
                        <td class="fw-semibold">{{ $challenge->title }}</td>
                        <td><span class="badge bg-success rounded-pill px-3 py-2">+{{ $challenge->point_reward }} pts</span></td>
                        <td>{{ \Carbon\Carbon::parse($challenge->start_date)->format('d M') }} -
                            {{ \Carbon\Carbon::parse($challenge->end_date)->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.challenges.edit', $challenge) }}"
                                class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.challenges.review', $challenge->id) }}"
                                class="btn btn-sm btn-outline-info rounded-pill px-3 me-1">
                                <i class="fas fa-tasks me-1"></i>Review
                            </a>
                            <form action="{{ route('admin.challenges.destroy', $challenge) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Are you sure you want to delete this challenge?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No challenges created yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($challenges->hasPages())
    <div class="card-footer bg-white border-0">{{ $challenges->links() }}</div>
    @endif
</div>
@endsection
