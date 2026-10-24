@extends('layouts.app')

@section('title', 'Create New Community')

@section('content')
    <div class="col-lg-8 mx-auto">
        <h1 class="fw-bold mb-2">Create New Community</h1>
        <p class="text-muted mb-4">Invite fellow eco-enthusiasts and start making an impact together!</p>
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('communities.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Community Name</label>
                        <input type="text" name="name" id="name" class="form-control rounded-3" placeholder="e.g., Clean Beach Patrol" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Short Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control rounded-3" placeholder="Describe the mission, activities, and goals of this community..." required></textarea>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('communities.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-success rounded-pill px-4">Create Community</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
