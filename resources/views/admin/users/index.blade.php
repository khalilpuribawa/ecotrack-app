@extends('admin.layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
    <h1 class="mb-4">Manajemen Pengguna</h1>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Poin</th>
                        <th>Tgl. Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span
                                    class="badge {{ $user->role == 'admin' ? 'bg-primary' : 'bg-secondary' }}">{{ $user->role }}</span>
                            </td>
                            <td>{{ $user->points->total_points ?? 0 }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST">
                                        @csrf
                                        <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
@endsection