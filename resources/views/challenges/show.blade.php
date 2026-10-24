@extends('layouts.app')

@section('title', 'Challenge Details: ' . $challenge->title)

@section('content')
<style>
/* Custom styles */
.challenge-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 20px 20px 0 0;
    color: white;
    padding: 2rem;
}

.challenge-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.info-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    padding: 1rem;
    margin-bottom: 1rem;
}

.status-card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.btn-modern {
    border-radius: 12px;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.upload-area {
    border: 2px dashed #10b981;
    border-radius: 15px;
    padding: 2rem;
    background: #f0fdf4;
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #059669;
    background: #dcfce7;
}

.icon-large {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.progress-indicator {
    height: 8px;
    border-radius: 10px;
    background: #e5e7eb;
    overflow: hidden;
}

.progress-bar-custom {
    height: 100%;
    border-radius: 10px;
    transition: width 0.3s ease;
}
</style>

<div class="container py-4">
    {{-- Alerts --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card challenge-card">
        {{-- Header Section --}}
        <div class="challenge-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-large me-3">🏆</div>
                        <div>
                            <h1 class="mb-2 fw-bold">{{ $challenge->title }}</h1>
                            <p class="lead mb-0 opacity-90">{{ $challenge->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="info-badge text-center">
                        <div class="fs-2 fw-bold">{{ $challenge->point_reward }}</div>
                        <small class="opacity-90">Reward Points</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            {{-- Details Section --}}
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                        <div class="fs-3 me-3">📅</div>
                        <div>
                            <h6 class="mb-1 fw-semibold">Challenge Period</h6>
                            <p class="mb-0 text-muted">
                                {{ $challenge->start_date->format('d M Y') }} -
                                {{ $challenge->end_date->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                        <div class="fs-3 me-3">🎖️</div>
                        <div>
                            <h6 class="mb-1 fw-semibold">Point Reward</h6>
                            <span class="badge bg-success fs-6 px-3 py-2 rounded-pill">{{ $challenge->point_reward }}
                                Points</span>
                        </div>
                    </div>
                </div>
                @if($challenge->badge)
                <div class="col-12">
                    <div
                        class="d-flex align-items-center p-3 bg-warning bg-opacity-10 rounded-3 border border-warning border-opacity-25">
                        <div class="fs-3 me-3">🏅</div>
                        <div>
                            <h6 class="mb-1 fw-semibold text-warning-emphasis">Exclusive Badge</h6>
                            <p class="mb-0 text-warning-emphasis">
                                Earn the "{{ ucwords(str_replace('-', ' ', $challenge->badge)) }}" badge
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Status Section --}}
            @if($participation)
            {{-- >>> USER ALREADY JOINED <<< --}}

            @if ($participation->pivot->status == 'rejected')
            {{-- Status: Rejected --}}
            <div class="status-card bg-danger bg-opacity-10 border border-danger border-opacity-25 p-4 mb-4">
                <div class="text-center">
                    <div class="fs-1 text-danger mb-3">❌</div>
                    <h4 class="text-danger-emphasis fw-bold mb-3">Submission Rejected</h4>
                    <p class="text-danger-emphasis mb-3">Sorry, your previously submitted proof was rejected. Please try again with clearer proof.</p>
                    @if($participation->pivot->admin_feedback)
                    <div class="alert alert-danger border-0 rounded-3">
                        <h6 class="fw-semibold mb-2">💬 Admin Feedback:</h6>
                        <p class="mb-0">{{ $participation->pivot->admin_feedback }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            @if (in_array($participation->pivot->status, ['joined', 'rejected']))
            {{-- Status: Upload Form --}}
            <div class="status-card bg-primary bg-opacity-5 border border-primary border-opacity-25 p-4">
                <div class="text-center mb-4">
                    <div class="fs-1 mb-3">📸</div>
                    <h4 class="text-primary-emphasis fw-bold mb-2">Upload Proof of Participation</h4>
                    <p class="text-muted">Upload a clear photo showing you have completed this challenge</p>
                </div>

                <form action="{{ route('challenges.submitProof', $challenge->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="upload-area text-center mb-4">
                        <div class="fs-2 text-success mb-3">📁</div>
                        <h6 class="fw-semibold mb-2">Choose Proof Photo</h6>
                        <p class="text-muted small mb-3">Format: JPG, PNG • Max size: 2MB</p>
                        <input class="form-control form-control-lg @error('proof_image') is-invalid @enderror"
                            type="file" id="proof_image" name="proof_image" required accept="image/*">
                        @error('proof_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-modern btn-lg px-5">
                            <i class="fas fa-upload me-2"></i>Submit Proof
                        </button>
                    </div>
                </form>
            </div>

            @elseif ($participation->pivot->status == 'submitted')
            {{-- Status: Under Review --}}
            <div class="status-card bg-warning bg-opacity-10 border border-warning border-opacity-25 p-4">
                <div class="text-center">
                    <div class="fs-1 text-warning mb-3">⏳</div>
                    <h4 class="text-warning-emphasis fw-bold mb-3">Under Review</h4>
                    <p class="text-warning-emphasis mb-4">Your proof has been submitted and is currently being reviewed by an admin. Thank you for taking action!</p>

                    <div class="progress-indicator mb-3">
                        <div class="progress-bar-custom bg-warning" style="width: 75%"></div>
                    </div>
                    <small class="text-muted">Status: Pending Admin Approval</small>
                </div>
            </div>

            @elseif ($participation->pivot->status == 'completed')
            {{-- Status: Completed --}}
            <div class="status-card bg-success bg-opacity-10 border border-success border-opacity-25 p-4">
                <div class="text-center">
                    <div class="fs-1 mb-3">🎉</div>
                    <h4 class="text-success-emphasis fw-bold mb-3">Congratulations! Challenge Completed!</h4>
                    <p class="text-success-emphasis mb-4">You have successfully completed this challenge. Points and badge (if applicable) have been added to your profile.</p>

                    <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                            <div class="bg-success bg-opacity-20 rounded-3 p-3">
                                <div class="fs-4 text-success">+{{ $challenge->point_reward }}</div>
                                <small class="text-success-emphasis">Points Earned</small>
                            </div>
                        </div>
                        @if($challenge->badge)
                        <div class="col-auto">
                            <div class="bg-warning bg-opacity-20 rounded-3 p-3">
                                <div class="fs-4">🏅</div>
                                <small class="text-warning-emphasis">Badge Unlocked</small>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="progress-indicator mt-4 mb-3">
                        <div class="progress-bar-custom bg-success" style="width: 100%"></div>
                    </div>
                    <small class="text-success-emphasis fw-semibold">Status: Completed ✓</small>
                </div>
            </div>
            @endif

            @else
            {{-- >>> USER NOT JOINED <<< --}}
            <div class="status-card bg-light border-0 p-5">
                <div class="text-center">
                    <div class="fs-1 text-primary mb-4">🚀</div>
                    <h4 class="fw-bold mb-3">Ready to Take on the Challenge?</h4>
                    <p class="text-muted mb-4 fs-5">Join now and start your green journey towards a cleaner planet!</p>

                    <form action="{{ route('challenges.participate', $challenge) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-modern btn-lg px-5 py-3">
                            <i class="fas fa-play me-2"></i>Join This Challenge!
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>

        <div class="card-footer bg-light border-0 p-4">
            <div class="text-center">
                <a href="{{ route('challenges.index') }}" class="btn btn-outline-secondary btn-modern px-4">
                    <i class="fas fa-arrow-left me-2"></i>Back to Challenges
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// File input enhancement
document.getElementById('proof_image')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const uploadArea = this.closest('.upload-area');
        uploadArea.style.borderColor = '#059669';
        uploadArea.style.backgroundColor = '#dcfce7';

        // Show file name
        const fileName = document.createElement('small');
        fileName.className = 'text-success fw-semibold d-block mt-2';
        fileName.textContent = `Selected file: ${file.name}`;

        // Remove previous file name if exists
        const existingFileName = uploadArea.querySelector('.file-name');
        if (existingFileName) existingFileName.remove();

        fileName.classList.add('file-name');
        uploadArea.appendChild(fileName);
    }
});
</script>
@endsection
