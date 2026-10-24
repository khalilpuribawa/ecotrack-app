@extends('admin.layouts.app')
@section('title', 'Review Submissions')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Review Submissions</h1>
            <p class="text-muted mb-0">Challenge: <strong>{{ $challenge->title }}</strong></p>
        </div>
        <a href="{{ route('admin.challenges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-1"></i>Back to Challenges
        </a>
    </div>

    @if(session('success')) <div class="alert alert-success rounded-4 border-0 shadow-sm">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger rounded-4 border-0 shadow-sm">{{ session('error') }}</div> @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Proof Photo</th>
                            <th>Submitted</th>
                            <th style="width: 25%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $user)
                        <tr>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>
                                @if ($user->pivot->submitted_proof)
                                <a href="{{ asset('storage/' . $user->pivot->submitted_proof) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $user->pivot->submitted_proof) }}" alt="Submitted Proof"
                                        class="rounded-3 shadow-sm" style="max-width: 120px; height: auto;">
                                </a>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->pivot->submitted_at)->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    {{-- Approve Button --}}
                                    <form
                                        action="{{ route('admin.challenges.submissions.approve', ['challenge' => $challenge, 'user' => $user]) }}"
                                        method="POST" class="d-inline flex-grow-1">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm w-100 rounded-pill">
                                            <i class="fas fa-check me-1"></i>Approve
                                        </button>
                                    </form>
                                    {{-- Reject Button --}}
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill flex-grow-1" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal-{{ $user->id }}">
                                        <i class="fas fa-times me-1"></i>Reject
                                    </button>
                                </div>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal-{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <form
                                                action="{{ route('admin.challenges.submissions.reject', ['challenge' => $challenge, 'user' => $user]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-bold">Reject Submission from {{ $user->name }}</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="admin_feedback-{{ $user->id }}"
                                                        class="form-label fw-semibold">Rejection Feedback (Optional)</label>
                                                    <textarea class="form-control rounded-3" id="admin_feedback-{{ $user->id }}"
                                                        name="admin_feedback" rows="3" placeholder="Explain why the proof was insufficient..."></textarea>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button" class="btn btn-secondary rounded-pill px-4"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger rounded-pill px-4">Confirm Rejection</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No pending submissions to review.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
