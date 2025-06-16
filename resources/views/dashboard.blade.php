@extends('layouts.app')

@section('title', 'Dashboard - EcoTrack.ID')

@section('content')
<style>
.dashboard-hero {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    border-radius: 20px;
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
}

.dashboard-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M20 20c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10zm10 0c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10z'/%3E%3C/g%3E%3C/svg%3E") repeat;
    animation: float 20s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateX(0) translateY(0);
    }

    50% {
        transform: translateX(-20px) translateY(-20px);
    }
}

.hero-content {
    position: relative;
    z-index: 1;
    padding: 3rem 2rem;
}

.welcome-badge {
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
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    line-height: 1.5;
}

.points-display {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-action {
    padding: 0.875rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
}

.btn-action::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-action:hover::before {
    left: 100%;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.btn-primary-action {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-primary-action:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
}

.btn-secondary-action {
    background: rgba(255, 255, 255, 0.9);
    color: #047857;
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.btn-secondary-action:hover {
    background: white;
    color: #047857;
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #10b981, #34d399);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.stat-icon.reports {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.stat-icon.challenges {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.stat-icon.points {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: white;
}

.stat-icon.rank {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: white;
}

.stat-number {
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 500;
}

/* Section Headers */
.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.section-icon.reports {
    background: linear-gradient(135deg, #fef2f2, #fee2e2);
    color: #dc2626;
}

.section-icon.challenges {
    background: linear-gradient(135deg, #fffbeb, #fef3c7);
    color: #d97706;
}

.view-all-btn {
    background: none;
    border: 2px solid #e5e7eb;
    color: #6b7280;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
}

.view-all-btn:hover {
    border-color: #10b981;
    color: #10b981;
    background: #f0fdf4;
}

/* Modern Cards */
.modern-card {
    background: white;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    overflow: hidden;
    margin-bottom: 1rem;
}

.modern-card:hover {
    border-color: #10b981;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    transform: translateY(-2px);
}

.card-header-modern {
    padding: 1.25rem 1.5rem 0;
    border: none;
    background: none;
}

.card-body-modern {
    padding: 0 1.5rem 1.25rem;
}

.card-title-modern {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-text-modern {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-approved {
    background: #d1fae5;
    color: #065f46;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

.challenge-reward {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    background: #f0fdf4;
    color: #059669;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.btn-detail {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-detail:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    color: white;
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: #6b7280;
}

.empty-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1rem;
    color: #9ca3af;
}

.empty-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.empty-text {
    font-size: 0.9rem;
    color: #6b7280;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .action-buttons {
        flex-direction: column;
    }

    .btn-action {
        width: 100%;
        justify-content: center;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .hero-content {
        padding: 2rem 1.5rem;
    }
}
</style>

<!-- Hero Section -->
<div class="dashboard-hero">
    <div class="hero-content">
        <div class="welcome-badge">
            🎉 Selamat Datang Kembali
        </div>
        <h1 class="hero-title">Halo, {{ $user->name }}!</h1>
        <p class="hero-subtitle">
            Terima kasih telah menjadi bagian dari komunitas EcoTrack.ID.
            Mari terus berkontribusi untuk bumi yang lebih hijau dan berkelanjutan.
        </p>
        <div class="points-display">
            <i class="fas fa-coins"></i>
            <span>{{ number_format($user->points) }} Poin EcoTrack</span>
        </div>
        <div class="action-buttons">
            <a href="{{ route('reports.create') }}" class="btn btn-action btn-primary-action">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Lapor Masalah Lingkungan
            </a>
            <a href="{{ route('challenges.index') }}" class="btn btn-action btn-secondary-action">
                <i class="fas fa-trophy me-2"></i>
                Lihat Tantangan
            </a>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon reports">
            <i class="fas fa-file-alt"></i>
        </div>
        <div class="stat-number">{{ $myReports->count() }}</div>
        <div class="stat-label">Total Laporan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon challenges">
            <i class="fas fa-trophy"></i>
        </div>
        <div class="stat-number">{{ $activeChallenges->count() }}</div>
        <div class="stat-label">Tantangan Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon points">
            <i class="fas fa-star"></i>
        </div>
        <div class="stat-number">{{ number_format($user->points) }}</div>
        <div class="stat-label">Total Poin</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon rank">
            <i class="fas fa-medal"></i>
        </div>
        <div class="stat-number">#{{ rand(1, 100) }}</div>
        <div class="stat-label">Peringkat</div>
    </div>
</div>

<!-- Content Grid -->
<div class="row">
    <!-- Recent Reports -->
    <div class="col-lg-6 mb-4">
        <div class="section-header">
            <h3 class="section-title">
                <div class="section-icon reports">
                    <i class="fas fa-file-alt"></i>
                </div>
                Laporan Terakhir
            </h3>
            <a href="{{ route('reports.index') }}" class="view-all-btn">
                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        @forelse ($myReports->take(3) as $report)
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-map-marker-alt text-danger"></i>
                    {{ $report->category }}
                </h5>
            </div>
            <div class="card-body-modern">
                <p class="card-text-modern">{{ Str::limit($report->description, 120) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="status-badge status-{{ strtolower($report->status) }}">
                        {{ $report->status }}
                    </span>
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        {{ $report->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <h4 class="empty-title">Belum Ada Laporan</h4>
            <p class="empty-text">Mulai berkontribusi dengan membuat laporan masalah lingkungan pertama Anda.</p>
            <a href="{{ route('reports.create') }}" class="btn btn-detail mt-2">
                <i class="fas fa-plus me-1"></i>
                Buat Laporan
            </a>
        </div>
        @endforelse
    </div>

    <!-- Active Challenges -->
    <div class="col-lg-6 mb-4">
        <div class="section-header">
            <h3 class="section-title">
                <div class="section-icon challenges">
                    <i class="fas fa-trophy"></i>
                </div>
                Tantangan Aktif
            </h3>
            <a href="{{ route('challenges.index') }}" class="view-all-btn">
                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        @forelse ($activeChallenges->take(3) as $challenge)
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-leaf text-success"></i>
                    {{ $challenge->title }}
                </h5>
            </div>
            <div class="card-body-modern">
                <div class="challenge-reward">
                    <i class="fas fa-coins"></i>
                    {{ number_format($challenge->point_reward) }} Poin
                </div>
                <p class="card-text-modern">
                    {{ Str::limit($challenge->description ?? 'Ikuti tantangan ini untuk mendapatkan poin dan berkontribusi pada lingkungan.', 100) }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('challenges.show', $challenge) }}" class="btn-detail">
                        <i class="fas fa-eye me-1"></i>
                        Lihat Detail
                    </a>
                    <small class="text-muted">
                        <i class="fas fa-users me-1"></i>
                        {{ rand(10, 100) }} peserta
                    </small>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-trophy"></i>
            </div>
            <h4 class="empty-title">Tidak Ada Tantangan</h4>
            <p class="empty-text">Saat ini tidak ada tantangan aktif. Pantau terus untuk tantangan baru!</p>
            <a href="{{ route('challenges.index') }}" class="btn btn-detail mt-2">
                <i class="fas fa-search me-1"></i>
                Cari Tantangan
            </a>
        </div>
        @endforelse
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-bolt text-warning"></i>
                    Aksi Cepat
                </h5>
            </div>
            <div class="card-body-modern">
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <a href="{{ route('reports.create') }}"
                            class="btn btn-outline-danger w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                            <span class="fw-semibold">Lapor Masalah</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('green-map.index') }}"
                            class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3">
                            <i class="fas fa-map fa-2x mb-2"></i>
                            <span class="fw-semibold">Peta Hijau</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('challenges.index') }}"
                            class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3">
                            <i class="fas fa-trophy fa-2x mb-2"></i>
                            <span class="fw-semibold">Tantangan</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('reports.index') }}"
                            class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3">
                            <i class="fas fa-chart-line fa-2x mb-2"></i>
                            <span class="fw-semibold">Statistik</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection