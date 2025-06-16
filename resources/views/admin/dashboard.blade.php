@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
/* Enhanced Admin Dashboard Styles */
.dashboard-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.dashboard-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    color: white;
    padding: 2.5rem;
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
}

.dashboard-header::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 150px;
    height: 150px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite reverse;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0px) rotate(0deg);
    }

    50% {
        transform: translateY(-20px) rotate(180deg);
    }
}

.dashboard-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 2;
}

.dashboard-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    font-weight: 400;
    margin: 0;
    position: relative;
    z-index: 2;
}

.dashboard-date {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 1rem 1.5rem;
    font-weight: 600;
    position: relative;
    z-index: 2;
}

.stats-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    height: 100%;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--card-gradient);
    transition: height 0.3s ease;
}

.stats-card:hover::before {
    height: 8px;
}

.stats-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.stats-card.primary {
    --card-gradient: linear-gradient(135deg, #667eea, #764ba2);
}

.stats-card.warning {
    --card-gradient: linear-gradient(135deg, #f093fb, #f5576c);
}

.stats-card.info {
    --card-gradient: linear-gradient(135deg, #4facfe, #00f2fe);
}

.stats-card.success {
    --card-gradient: linear-gradient(135deg, #43e97b, #38f9d7);
}

.stats-icon-container {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    background: var(--card-gradient);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    position: relative;
    overflow: hidden;
}

.stats-icon-container::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: rotate(45deg);
    transition: transform 0.6s ease;
}

.stats-card:hover .stats-icon-container::before {
    transform: rotate(45deg) translate(100%, 100%);
}

.stats-content {
    flex: 1;
    margin-left: 1.5rem;
}

.stats-label {
    font-size: 0.85rem;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.stats-number {
    font-size: 2.25rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1;
}

.stats-trend {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    padding: 0.5rem 0.75rem;
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.03);
}

.trend-success {
    color: #059669;
    background: rgba(5, 150, 105, 0.1);
}

.trend-warning {
    color: #d97706;
    background: rgba(217, 119, 6, 0.1);
}

.trend-info {
    color: #0284c7;
    background: rgba(2, 132, 199, 0.1);
}

.quick-actions-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: none;
    margin-top: 2rem;
}

.quick-actions-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.quick-actions-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.quick-actions-title {
    color: #1e293b;
    font-weight: 700;
    font-size: 1.5rem;
    margin: 0;
}

.action-btn {
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 15px;
    padding: 1.5rem;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 1rem;
    color: #475569;
    position: relative;
    overflow: hidden;
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--btn-gradient);
    transition: left 0.3s ease;
    z-index: 0;
}

.action-btn:hover::before {
    left: 0;
}

.action-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    border-color: transparent;
    color: white;
}

.action-btn i,
.action-btn span {
    position: relative;
    z-index: 1;
    transition: color 0.3s ease;
}

.action-btn.primary {
    --btn-gradient: linear-gradient(135deg, #667eea, #764ba2);
}

.action-btn.warning {
    --btn-gradient: linear-gradient(135deg, #f093fb, #f5576c);
}

.action-btn.info {
    --btn-gradient: linear-gradient(135deg, #4facfe, #00f2fe);
}

.action-btn.success {
    --btn-gradient: linear-gradient(135deg, #43e97b, #38f9d7);
}

.action-icon {
    width: 45px;
    height: 45px;
    background: #f1f5f9;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.action-btn:hover .action-icon {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.05);
    }

    100% {
        transform: scale(1);
    }
}

@media (max-width: 768px) {
    .dashboard-title {
        font-size: 2rem;
    }

    .stats-number {
        font-size: 1.75rem;
    }

    .stats-card,
    .quick-actions-card {
        padding: 1.5rem;
    }

    .dashboard-header {
        padding: 2rem;
    }
}
</style>

<div class="dashboard-container">
    <div class="container-fluid px-4">
        <!-- Enhanced Header Section -->
        <div class="dashboard-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="dashboard-title">👋 Dashboard Admin</h1>
                    <p class="dashboard-subtitle">Selamat datang di panel kontrol EcoTrack.ID</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="dashboard-date">
                        <i class="fas fa-calendar-alt me-2"></i>
                        {{ date('d M Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="stats-card primary">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon-container">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-label">Total Pengguna</div>
                            <div class="stats-number">{{ number_format($stats['total_users']) }}</div>
                            <div class="stats-trend trend-success">
                                <i class="fas fa-arrow-up"></i>
                                <span>Aktif & Berkembang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stats-card warning pulse-animation">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon-container">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-label">Laporan Menunggu</div>
                            <div class="stats-number">{{ number_format($stats['pending_reports']) }}</div>
                            <div class="stats-trend trend-warning">
                                <i class="fas fa-clock"></i>
                                <span>Perlu Verifikasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stats-card info">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon-container">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-label">Titik Hijau Menunggu</div>
                            <div class="stats-number">{{ number_format($stats['pending_green_points']) }}</div>
                            <div class="stats-trend trend-info">
                                <i class="fas fa-hourglass-half"></i>
                                <span>Dalam Proses</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stats-card success">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon-container">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-label">Tantangan Aktif</div>
                            <div class="stats-number">{{ number_format($stats['active_challenges']) }}</div>
                            <div class="stats-trend trend-success">
                                <i class="fas fa-play"></i>
                                <span>Sedang Berjalan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="quick-actions-card">
                    <div class="quick-actions-header">
                        <div class="quick-actions-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h2 class="quick-actions-title">Aksi Cepat</h2>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="action-btn primary w-100">
                                <div class="action-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <span>Tambah Pengguna</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="action-btn warning w-100">
                                <div class="action-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <span>Verifikasi Laporan</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="action-btn info w-100">
                                <div class="action-icon">
                                    <i class="fas fa-map"></i>
                                </div>
                                <span>Kelola Titik Hijau</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="action-btn success w-100">
                                <div class="action-icon">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <span>Buat Tantangan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced animations and interactions
document.addEventListener('DOMContentLoaded', function() {
    // Animate numbers on page load
    const numbers = document.querySelectorAll('.stats-number');
    numbers.forEach(number => {
        const finalValue = parseInt(number.textContent.replace(/,/g, ''));
        let currentValue = 0;
        const increment = finalValue / 60;

        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                number.textContent = finalValue.toLocaleString();
                clearInterval(timer);
            } else {
                number.textContent = Math.floor(currentValue).toLocaleString();
            }
        }, 25);
    });

    // Add stagger animation to cards
    const cards = document.querySelectorAll('.stats-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.style.animation = 'fadeInUp 0.6s ease forwards';
    });

    // Add hover sound effect (optional)
    const actionBtns = document.querySelectorAll('.action-btn');
    actionBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});

// Add CSS animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection