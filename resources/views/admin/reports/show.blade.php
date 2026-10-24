@extends('admin.layouts.app')

@section('title', 'Environmental Report Details')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Report Details: {{ $report->category }}</h1>
            <p class="text-muted mb-0">Report ID: #{{ str_pad($report->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-1"></i>Back to Reports
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3 text-success"><i class="fas fa-map-marker-alt me-2"></i>Incident Location</h5>
                    <div class="bg-light p-3 rounded-3 mb-3">
                        <p class="mb-1"><strong>Latitude:</strong> <code>{{ $report->latitude }}</code></p>
                        <p class="mb-0"><strong>Longitude:</strong> <code>{{ $report->longitude }}</code></p>
                    </div>

                    <h5 class="fw-bold mb-2 text-success"><i class="fas fa-align-left me-2"></i>Description</h5>
                    <p class="text-secondary bg-light p-3 rounded-3">{{ $report->description }}</p>

                    <h5 class="fw-bold mb-2 text-success"><i class="fas fa-info-circle me-2"></i>Current Status</h5>
                    <p>
                        <span class="badge {{ $report->status === 'resolved' ? 'bg-success' : ($report->status === 'verified' ? 'bg-info' : 'bg-warning text-dark') }} fs-6 px-3 py-2 rounded-pill text-uppercase">
                            {{ $report->status }}
                        </span>
                    </p>

                    <h5 class="fw-bold mb-2 text-success"><i class="fas fa-user me-2"></i>Reported By</h5>
                    <p class="text-secondary">
                        <strong>{{ $report->user->name }}</strong> on {{ $report->created_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <div class="col-md-6">
                    <h5 class="fw-bold mb-3 text-success"><i class="fas fa-image me-2"></i>Attached Evidence</h5>
                    @if($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" alt="Incident Evidence Photo" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 450px; object-fit: cover;">
                    @else
                        <div class="alert alert-secondary rounded-4 text-center py-5">
                            <i class="fas fa-image fs-1 mb-2 d-block opacity-50"></i>
                            No photo attached to this report.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
