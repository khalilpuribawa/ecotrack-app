@extends('layouts.app')

@section('title', 'Eco-Challenge Mingguan - EcoTrack.ID')

@section('content')
<style>
.challenges-hero {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
    border-radius: 20px;
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
}

.challenges-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    animation: float 20s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateX(0) translateY(0);
    }

    50% {
        transform: translateX(-30px) translateY(-30px);
    }
}

.hero-content {
    position: relative;
    z-index: 1;
    padding: 2.5rem 2rem;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.15);
    color: rgba(255, 255, 255, 0.95);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hero-title {
    font-size: 2.25rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.hero-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1rem;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-number {
    font-size: 1.25rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
}

/* Filter Section */
.filter-section {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
    border: 1px solid #e5e7eb;
}

.filter-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.filter-buttons {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border: 2px solid #e5e7eb;
    background: white;
    color: #6b7280;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.filter-btn:hover {
    border-color: #f59e0b;
    color: #d97706;
    background: #fffbeb;
}

.filter-btn.active {
    border-color: #f59e0b;
    background: #f59e0b;
    color: white;
}

/* Challenge Cards */
.challenges-grid {
    display: grid;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.challenge-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    position: relative;
}

.challenge-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    border-color: #f59e0b;
}

.challenge-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #f59e0b, #d97706);
}

.card-header-modern {
    padding: 1.5rem 1.5rem 0;
    background: none;
    border: none;
}

.challenge-status {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    margin-bottom: 1rem;
}

.status-active {
    background: #d1fae5;
    color: #065f46;
}

.status-upcoming {
    background: #dbeafe;
    color: #1e40af;
}

.status-ended {
    background: #fee2e2;
    color: #991b1b;
}

.challenge-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.75rem;
    line-height: 1.3;
}

.challenge-description {
    color: #6b7280;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.challenge-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #6b7280;
}

.meta-icon {
    width: 20px;
    height: 20px;
    background: #f3f4f6;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    color: #9ca3af;
}

.card-body-modern {
    padding: 0 1.5rem 1.5rem;
}

.challenge-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.points-display {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    color: #166534;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    font-weight: 600;
    border: 1px solid #bbf7d0;
}

.points-number {
    font-size: 1.25rem;
    font-weight: 800;
}

.challenge-btn {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
}

.challenge-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.challenge-btn:hover::before {
    left: 100%;
}

.challenge-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
    color: white;
}

.challenge-btn.disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.challenge-btn.disabled::before {
    display: none;
}

/* Progress Bar */
.challenge-progress {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #f3f4f6;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.progress-text {
    color: #374151;
    font-weight: 500;
}

.progress-percentage {
    color: #6b7280;
}

.progress-bar-container {
    height: 8px;
    background: #f3f4f6;
    border-radius: 4px;
    overflow: hidden;
}

.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #f59e0b, #d97706);
    border-radius: 4px;
    transition: width 0.3s ease;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
}

.empty-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 1.5rem;
    color: #d97706;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: 0.5rem;
}

.empty-text {
    font-size: 1rem;
    color: #6b7280;
    max-width: 400px;
    margin: 0 auto 1.5rem;
    line-height: 1.5;
}

.empty-btn {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.empty-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
    color: white;
}

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination .page-link {
    border: 1px solid #e5e7eb;
    color: #6b7280;
    padding: 0.75rem 1rem;
    margin: 0 0.25rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: #f59e0b;
    border-color: #f59e0b;
    color: white;
}

.pagination .page-item.active .page-link {
    background: #f59e0b;
    border-color: #f59e0b;
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.75rem;
    }

    .hero-stats {
        flex-direction: column;
        gap: 1rem;
    }

    .stat-item {
        width: 100%;
        justify-content: center;
    }

    .filter-buttons {
        flex-direction: column;
    }

    .filter-btn {
        width: 100%;
        text-align: center;
    }

    .challenge-footer {
        flex-direction: column;
        align-items: stretch;
    }

    .challenge-btn {
        width: 100%;
        justify-content: center;
    }

    .hero-content {
        padding: 2rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .challenge-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .points-display {
        width: 100%;
        justify-content: center;
    }
}
</style>

<!-- Hero Section -->
<div class="challenges-hero">
    <div class="hero-content">
        <div class="hero-badge">
            🏆 Weekly Eco-Challenge
        </div>
        <h1 class="hero-title">Tantangan Hijau Tersedia</h1>
        <p class="hero-subtitle">
            Ikuti tantangan mingguan, kumpulkan poin, dan buktikan kepedulianmu terhadap lingkungan!
            Setiap aksi kecil membuat perbedaan besar untuk planet kita.
        </p>
        <div class="hero-stats">
            <div class="stat-item">
                <i class="fas fa-trophy"></i>
                <div>
                    <div class="stat-number">{{ $challenges->count() }}</div>
                    <div class="stat-label">Tantangan Aktif</div>
                </div>
            </div>
            <div class="stat-item">
                <i class="fas fa-users"></i>
                <div>
                    <div class="stat-number">{{ rand(150, 500) }}</div>
                    <div class="stat-label">Peserta Aktif</div>
                </div>
            </div>
            <div class="stat-item">
                <i class="fas fa-coins"></i>
                <div>
                    <div class="stat-number">{{ $challenges->sum('point_reward') }}</div>
                    <div class="stat-label">Total Poin Tersedia</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <div class="filter-title">
        <i class="fas fa-filter"></i>
        Filter Tantangan
    </div>
    <div class="filter-buttons">
        <a href="#" class="filter-btn active">
            <i class="fas fa-list me-1"></i>
            Semua Tantangan
        </a>
        <a href="#" class="filter-btn">
            <i class="fas fa-play me-1"></i>
            Sedang Berlangsung
        </a>
        <a href="#" class="filter-btn">
            <i class="fas fa-clock me-1"></i>
            Akan Datang
        </a>
        <a href="#" class="filter-btn">
            <i class="fas fa-star me-1"></i>
            Poin Tertinggi
        </a>
    </div>
</div>

<!-- Challenges Grid -->
<div class="challenges-grid">
    @forelse ($challenges as $challenge)
    <div class="challenge-card">
        <div class="card-header-modern">
            @php
            $now = now();
            $startDate = \Carbon\Carbon::parse($challenge->start_date);
            $endDate = \Carbon\Carbon::parse($challenge->end_date);

            if ($now->lt($startDate)) {
            $status = 'upcoming';
            $statusText = 'Akan Datang';
            $statusIcon = 'clock';
            } elseif ($now->between($startDate, $endDate)) {
            $status = 'active';
            $statusText = 'Sedang Berlangsung';
            $statusIcon = 'play';
            } else {
            $status = 'ended';
            $statusText = 'Berakhir';
            $statusIcon = 'stop';
            }
            @endphp

            <div class="challenge-status status-{{ $status }}">
                <i class="fas fa-{{ $statusIcon }}"></i>
                {{ $statusText }}
            </div>

            <h3 class="challenge-title">{{ $challenge->title }}</h3>
            <p class="challenge-description">{{ Str::limit($challenge->description, 180) }}</p>

            <div class="challenge-meta">
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <span>{{ $startDate->format('d M') }} - {{ $endDate->format('d M Y') }}</span>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <span>{{ $endDate->diffForHumans($now) }}</span>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <span>{{ rand(20, 80) }} peserta</span>
                </div>
            </div>
        </div>

        <div class="card-body-modern">
            <div class="challenge-footer">
                <div class="points-display">
                    <i class="fas fa-coins"></i>
                    <span class="points-number">{{ number_format($challenge->point_reward) }}</span>
                    <span>Poin</span>
                </div>

                @if($status === 'active')
                <a href="{{ route('challenges.show', $challenge) }}" class="challenge-btn">
                    <i class="fas fa-play"></i>
                    Ikuti Tantangan
                </a>
                @elseif($status === 'upcoming')
                <a href="{{ route('challenges.show', $challenge) }}" class="challenge-btn">
                    <i class="fas fa-eye"></i>
                    Lihat Detail
                </a>
                @else
                <button class="challenge-btn disabled" disabled>
                    <i class="fas fa-stop"></i>
                    Tantangan Berakhir
                </button>
                @endif
            </div>

            @if($status === 'active')
            <div class="challenge-progress">
                @php
                $totalDays = $startDate->diffInDays($endDate);
                $passedDays = $startDate->diffInDays($now);
                $progressPercentage = $totalDays > 0 ? min(100, ($passedDays / $totalDays) * 100) : 0;
                @endphp

                <div class="progress-label">
                    <span class="progress-text">Progress Waktu</span>
                    <span class="progress-percentage">{{ number_format($progressPercentage, 1) }}%</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: {{ $progressPercentage }}%"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-trophy"></i>
        </div>
        <h3 class="empty-title">Tidak Ada Tantangan Tersedia</h3>
        <p class="empty-text">
            Saat ini tidak ada tantangan yang tersedia. Pantau terus halaman ini untuk tantangan baru yang menarik!
        </p>
        <a href="{{ route('dashboard') }}" class="empty-btn">
            <i class="fas fa-home"></i>
            Kembali ke Dashboard
        </a>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($challenges->hasPages())
<div class="pagination-container">
    {{ $challenges->links() }}
</div>
@endif

<script>
// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        // Remove active class from all buttons
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));

        // Add active class to clicked button
        this.classList.add('active');

        // Here you can add filtering logic
        // For now, it's just visual feedback
    });
});

// Auto-refresh challenge status every minute
setInterval(() => {
    if (document.visibilityState === 'visible') {
        // You can add AJAX call here to refresh challenge status
        console.log('Checking for challenge updates...');
    }
}, 60000);

// Animate progress bars on scroll
const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const progressBar = entry.target.querySelector('.progress-bar-fill');
            if (progressBar) {
                const width = progressBar.style.width;
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.width = width;
                }, 100);
            }
        }
    });
}, observerOptions);

document.querySelectorAll('.challenge-card').forEach(card => {
    observer.observe(card);
});
</script>
@endsection