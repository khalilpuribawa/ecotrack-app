@extends('layouts.app')

@section('title', $community->name)

@section('content')
    <div class="p-4 bg-light rounded-4 mb-4 border">
        <h1 class="display-5 fw-bold text-success">{{ $community->name }}</h1>
        <p class="lead text-secondary">{{ $community->description }}</p>
        <hr>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <p class="text-muted mb-0">
                <i class="fas fa-user-circle me-1"></i>Created by: <strong>{{ $community->creator->name }}</strong> &nbsp;|&nbsp; 
                <i class="fas fa-users me-1"></i>Total Members: <strong>{{ $community->members->count() }}</strong>
            </p>

            @if($isMember)
                <form action="{{ route('communities.leave', $community) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-4" onclick="return confirm('Are you sure you want to leave this community?')">
                        <i class="fas fa-sign-out-alt me-1"></i>Leave Community
                    </button>
                </form>
            @else
                <form action="{{ route('communities.join', $community) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-user-plus me-1"></i>Join Community
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success rounded-4 border-0 shadow-sm">{{ session('success') }}</div> @endif
    @if(session('error'))
    <div class="alert alert-danger rounded-4 border-0 shadow-sm">{{ session('error') }}</div> @endif

    <div class="row g-4">
        <div class="col-md-4">
            <h4 class="fw-bold mb-3"><i class="fas fa-users text-success me-2"></i>Members</h4>
            <ul class="list-group rounded-4 shadow-sm border-0">
                @foreach ($community->members as $member)
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom py-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                {{ strtoupper(substr($member->name, 0, 1)) }}
                            </div>
                            <span class="fw-medium">{{ $member->name }}</span>
                        </div>
                        @if($member->pivot->role === 'admin')
                            <span class="badge bg-primary rounded-pill px-2 py-1">Admin</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8">
            <h4 class="fw-bold mb-3"><i class="fas fa-comments text-success me-2"></i>Discussion Board</h4>
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    @if($isMember)
                        <form action="#" method="POST">
                            <div class="mb-3">
                                <textarea class="form-control rounded-3" rows="3"
                                    placeholder="Write a message or share an eco-tip to start a conversation..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4" disabled>Post Message (Coming Soon)</button>
                        </form>
                        <hr class="my-4">
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-comment-dots fs-1 text-muted opacity-50 mb-2"></i>
                            <p class="mb-0">No discussions posted yet. Start the first topic!</p>
                        </div>
                    @else
                        <div class="alert alert-warning text-center rounded-4 border-0 mb-0 py-4">
                            <i class="fas fa-lock fs-2 mb-2 d-block"></i>
                            You must join this community to view and participate in discussions.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
