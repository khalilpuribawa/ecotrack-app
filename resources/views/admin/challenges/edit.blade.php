@extends('admin.layouts.app')

@section('title', 'Edit Challenge: ' . $challenge->title)

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold mb-0">Edit Challenge</h1>
        <a href="{{ route('admin.challenges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.challenges.update', $challenge->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Challenge Title</label>
                    <input type="text" class="form-control rounded-3 @error('title') is-invalid @enderror" id="title" name="title"
                        value="{{ old('title', $challenge->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description</label>
                    <textarea class="form-control rounded-3 @error('description') is-invalid @enderror" id="description"
                        name="description" rows="4" required>{{ old('description', $challenge->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Point Reward --}}
                <div class="mb-3">
                    <label for="point_reward" class="form-label fw-semibold">Reward Points</label>
                    <input type="number" class="form-control rounded-3 @error('point_reward') is-invalid @enderror" id="point_reward"
                        name="point_reward" value="{{ old('point_reward', $challenge->point_reward) }}" required>
                    @error('point_reward')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Start & End Date --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label fw-semibold">Start Date</label>
                        <input type="date" class="form-control rounded-3 @error('start_date') is-invalid @enderror" id="start_date"
                            name="start_date" value="{{ old('start_date', $challenge->start_date->format('Y-m-d')) }}"
                            required>
                        @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label fw-semibold">End Date</label>
                        <input type="date" class="form-control rounded-3 @error('end_date') is-invalid @enderror" id="end_date"
                            name="end_date" value="{{ old('end_date', $challenge->end_date->format('Y-m-d')) }}" required>
                        @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Badge --}}
                <div class="mb-4">
                    <label for="badge" class="form-label fw-semibold">Badge Name (Optional)</label>
                    <input type="text" class="form-control rounded-3 @error('badge') is-invalid @enderror" id="badge" name="badge"
                        value="{{ old('badge', $challenge->badge) }}">
                    @error('badge')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-save me-1"></i>Update Challenge
                    </button>
                    <a href="{{ route('admin.challenges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
