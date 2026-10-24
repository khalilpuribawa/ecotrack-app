@extends('admin.layouts.app')
@section('title', 'Create New Challenge')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold mb-0">Create New Challenge</h1>
        <a href="{{ route('admin.challenges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            @if ($errors->any())
            <div class="alert alert-danger rounded-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.challenges.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Challenge Title</label>
                    <input type="text" class="form-control rounded-3" id="title" name="title" value="{{ old('title') }}" placeholder="e.g., 7 Days Without Single-Use Plastic" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description</label>
                    <textarea class="form-control rounded-3" id="description" name="description" rows="5" placeholder="Detail instructions and criteria for completing this challenge..." required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="point_reward" class="form-label fw-semibold">Reward Points</label>
                    <input type="number" class="form-control rounded-3" id="point_reward" name="point_reward" value="{{ old('point_reward') }}" placeholder="e.g., 50" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label fw-semibold">Start Date</label>
                        <input type="date" class="form-control rounded-3" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label fw-semibold">End Date</label>
                        <input type="date" class="form-control rounded-3" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="badge" class="form-label fw-semibold">Badge Name (Optional)</label>
                    <input type="text" class="form-control rounded-3" id="badge" name="badge" value="{{ old('badge') }}" placeholder="e.g., zero-waste-hero">
                    <small class="form-text text-muted">Use slug format (lowercase, no spaces, use hyphens). Example: 'zero-waste-champion'.</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-save me-1"></i>Save Challenge
                    </button>
                    <a href="{{ route('admin.challenges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
