@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0">User Management</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-success rounded-pill px-4">
        <i class="fas fa-plus me-1"></i> Add New User
    </a>
</div>
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Points</th>
                        <th>Joined Date</th>
                        <th>Change Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td><strong>#{{ $user->id }}</strong></td>
                        <td class="fw-semibold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->role == 'admin' ? 'bg-primary' : 'bg-secondary' }} rounded-pill px-3 py-2 text-uppercase">{{ $user->role }}</span>
                        </td>
                        <td><span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-2 rounded-pill">{{ $user->points }} pts</span></td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.updateRole', $user) }}" method="POST">
                                @csrf
                                <select name="role" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </form>
                            @else
                            <span class="badge bg-light text-muted">Current User</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer bg-white border-0">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
