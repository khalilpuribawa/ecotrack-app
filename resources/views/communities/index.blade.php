@extends('layouts.app')

@section('title', 'Green Communities')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Green Communities</h1>
        <a href="{{ route('communities.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i>Create New Community
        </a>
    </div>
    <p class="text-muted">Discover groups, discuss eco-friendly ideas, and collaborate on real environmental actions.</p>

    @forelse ($communities as $community)
        <div class="card mb-3 shadow-sm border-0 rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center p-4">
                <div>
                    <h4 class="card-title fw-bold text-success mb-2">{{ $community->name }}</h4>
                    <p class="card-text text-secondary mb-2">{{ Str::limit($community->description, 150) }}</p>
                    <small class="text-muted">
                        <i class="fas fa-user me-1"></i>Created by: {{ $community->creator->name }} &nbsp;|&nbsp;
                        <i class="fas fa-users me-1"></i>{{ $community->members_count }} Members
                    </small>
                </div>
                <div>
                    <a href="{{ route('communities.show', $community) }}" class="btn btn-outline-success rounded-pill px-4">
                        View & Join <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info rounded-4 border-0 shadow-sm">No communities found. Be the first to create one!</div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $communities->links() }}
    </div>
@endsection
