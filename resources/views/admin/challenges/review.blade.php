@extends('admin.layouts.app') {{-- Sesuaikan layout admin Anda --}}
@section('title', 'Review Submissions')

@section('content')
<div class="container">
    <h1 class="h3 mb-4">Review Submissions untuk: {{ $challenge->title }}</h1>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th>Bukti Foto</th>
                            <th>Waktu Submit</th>
                            <th style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if ($user->pivot->submitted_proof)
                                <a href="{{ asset('storage/' . $user->pivot->submitted_proof) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $user->pivot->submitted_proof) }}" alt="Bukti"
                                        style="max-width: 150px; height: auto;">
                                </a>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->pivot->submitted_at)->diffForHumans() }}</td>
                            <td>
                                {{-- Tombol Approve --}}
                                <form
                                    action="{{ route('admin.challenges.submissions.approve', ['challenge' => $challenge, 'user' => $user]) }}"
                                    method="POST" class="d-inline mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm w-100">Approve</button>
                                </form>
                                <hr class="my-1">
                                {{-- Tombol Reject dengan Modal --}}
                                <button type="button" class="btn btn-danger btn-sm w-100" data-bs-toggle="modal"
                                    data-bs-target="#rejectModal-{{ $user->id }}">Reject</button>

                                <!-- Modal untuk Reject -->
                                <div class="modal fade" id="rejectModal-{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form
                                                action="{{ route('admin.challenges.submissions.reject', ['challenge' => $challenge, 'user' => $user]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Submission dari {{ $user->name }}</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="admin_feedback-{{ $user->id }}"
                                                        class="form-label">Alasan Penolakan (Opsional)</label>
                                                    <textarea class="form-control" id="admin_feedback-{{ $user->id }}"
                                                        name="admin_feedback" rows="3"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Konfirmasi
                                                        Penolakan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada submission untuk direview.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection