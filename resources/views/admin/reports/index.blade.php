@extends('admin.layouts.app')

@section('title', 'Manajemen Laporan - Admin EcoTrack.ID')

@section('content')
<style>
.admin-header {
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    border-radius: 16px;
    color: white;
    padding: 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.admin-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    opacity: 0.1;
}

.admin-header-content {
    position: relative;
    z-index: 1;
}

.admin-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.admin-subtitle {
    font-size: 1rem;
    opacity: 0.8;
    margin: 0;
}

.title-icon {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

/* Modern Filter Buttons */
.filter-container {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
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
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.filter-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.filter-btn:hover::before {
    left: 100%;
}

.filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.filter-btn.btn-secondary {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    border-color: #6b7280;
}

.filter-btn.btn-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    border-color: #f59e0b;
}

.filter-btn.btn-info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: white;
    border-color: #06b6d4;
}

.filter-btn.btn-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border-color: #10b981;
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-left: 4px solid;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-card.pending {
    border-left-color: #f59e0b;
}

.stat-card.verified {
    border-left-color: #06b6d4;
}

.stat-card.resolved {
    border-left-color: #10b981;
}

.stat-card.total {
    border-left-color: #6b7280;
}

.stat-number {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 500;
}

/* Modern Table */
.table-container {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
}

.table-header {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.table-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-table {
    margin: 0;
    font-size: 0.9rem;
}

.modern-table thead th {
    background: #f8fafc;
    border: none;
    padding: 1rem 1.5rem;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    border-bottom: 2px solid #e5e7eb;
}

.modern-table tbody td {
    padding: 1rem 1.5rem;
    border: none;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
}

.modern-table tbody tr {
    transition: all 0.2s ease;
}

.modern-table tbody tr:hover {
    background: #f8fafc;
    transform: scale(1.01);
}

/* Status Badges */
.status-badge {
    padding: 0.375rem 0.875rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
}

.status-badge::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-verified {
    background: #cffafe;
    color: #0c4a6e;
}

.status-resolved {
    background: #d1fae5;
    color: #065f46;
}

/* Action Dropdown */
.action-dropdown {
    position: relative;
}

.action-btn {
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    border: 1px solid #d1d5db;
    color: #374151;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.action-btn:hover {
    background: linear-gradient(135deg, #e5e7eb, #d1d5db);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dropdown-menu-modern {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    padding: 0.5rem;
    margin-top: 0.5rem;
    min-width: 200px;
}

.dropdown-item-modern {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.dropdown-item-modern:hover {
    background: #f3f4f6;
    transform: translateX(4px);
}

.dropdown-item-modern.text-danger:hover {
    background: #fee2e2;
    color: #dc2626;
}

.dropdown-item-modern i {
    width: 16px;
    text-align: center;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #6b7280;
}

.empty-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 1.5rem;
    color: #9ca3af;
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
    margin: 0 auto;
}

/* Pagination */
.pagination-container {
    background: #f8fafc;
    padding: 1.5rem;
    border-top: 1px solid #e5e7eb;
}

/* ID Badge */
.id-badge {
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
    color: #3730a3;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    font-family: 'Courier New', monospace;
}

/* User Info */
.user-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #10b981, #059669);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.75rem;
}

.user-name {
    font-weight: 500;
    color: #374151;
}

/* Category Badge */
.category-badge {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    padding: 0.25rem 0.75rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

/* Date Display */
.date-display {
    color: #6b7280;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-title {
        font-size: 1.5rem;
    }

    .filter-buttons {
        flex-direction: column;
    }

    .filter-btn {
        width: 100%;
        text-align: center;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .modern-table {
        font-size: 0.8rem;
    }

    .modern-table thead th,
    .modern-table tbody td {
        padding: 0.75rem 0.5rem;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .admin-header {
        padding: 1.5rem;
    }
}
</style>

<!-- Admin Header -->
<div class="admin-header">
    <div class="admin-header-content">
        <h1 class="admin-title">
            <div class="title-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            Manajemen Laporan
        </h1>
        <p class="admin-subtitle">Kelola dan pantau semua laporan masalah lingkungan dari pengguna</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card total">
        <div class="stat-number">{{ $reports->total() }}</div>
        <div class="stat-label">Total Laporan</div>
    </div>
    <div class="stat-card pending">
        <div class="stat-number">{{ $reports->where('status', 'pending')->count() }}</div>
        <div class="stat-label">Menunggu Review</div>
    </div>
    <div class="stat-card verified">
        <div class="stat-number">{{ $reports->where('status', 'verified')->count() }}</div>
        <div class="stat-label">Terverifikasi</div>
    </div>
    <div class="stat-card resolved">
        <div class="stat-number">{{ $reports->where('status', 'resolved')->count() }}</div>
        <div class="stat-label">Selesai</div>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-container">
    <div class="filter-title">
        <i class="fas fa-filter"></i>
        Filter Status Laporan
    </div>
    <div class="filter-buttons">
        <a href="{{ route('admin.reports.index') }}"
            class="filter-btn btn-secondary {{ !request('status') ? 'active' : '' }}">
            <i class="fas fa-list me-2"></i>
            Semua Laporan
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}"
            class="filter-btn btn-warning {{ request('status') == 'pending' ? 'active' : '' }}">
            <i class="fas fa-clock me-2"></i>
            Pending
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'verified']) }}"
            class="filter-btn btn-info {{ request('status') == 'verified' ? 'active' : '' }}">
            <i class="fas fa-check-circle me-2"></i>
            Verified
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'resolved']) }}"
            class="filter-btn btn-success {{ request('status') == 'resolved' ? 'active' : '' }}">
            <i class="fas fa-check-double me-2"></i>
            Resolved
        </a>
    </div>
</div>

<!-- Table Container -->
<div class="table-container">
    <div class="table-header">
        <h3 class="table-title">
            <i class="fas fa-table"></i>
            Daftar Laporan
            @if(request('status'))
            <span class="badge bg-primary ms-2">{{ ucfirst(request('status')) }}</span>
            @endif
        </h3>
    </div>

    <div class="table-responsive">
        <table class="table modern-table">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag me-1"></i> ID</th>
                    <th><i class="fas fa-tag me-1"></i> Kategori</th>
                    <th><i class="fas fa-user me-1"></i> Pelapor</th>
                    <th><i class="fas fa-info-circle me-1"></i> Status</th>
                    <th><i class="fas fa-calendar me-1"></i> Tanggal</th>
                    <th><i class="fas fa-cogs me-1"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                <tr>
                    <td>
                        <span class="id-badge">#{{ str_pad($report->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                        <span class="category-badge">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $report->category }}
                        </span>
                    </td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($report->user->name, 0, 1)) }}
                            </div>
                            <span class="user-name">{{ $report->user->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge status-{{ $report->status }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="date-display">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $report->created_at->format('d M Y') }}
                        </div>
                    </td>
                    <td>
                        <div class="dropdown action-dropdown">
                            <button class="btn action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                                Aksi
                            </button>
                            <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item dropdown-item-modern"
                                        href="{{ route('admin.reports.show', $report) }}" target="_blank">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </a>
                                </li>

                                @if($report->status == 'pending')
                                <li>
                                    <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="verified">
                                        <button type="submit" class="dropdown-item dropdown-item-modern">
                                            <i class="fas fa-check-circle text-info"></i>
                                            Verifikasi
                                        </button>
                                    </form>
                                </li>
                                @endif

                                @if($report->status == 'verified')
                                <li>
                                    <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="resolved">
                                        <button type="submit" class="dropdown-item dropdown-item-modern">
                                            <i class="fas fa-check-double text-success"></i>
                                            Tandai Selesai
                                        </button>
                                    </form>
                                </li>
                                @endif

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('admin.reports.destroy', $report) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item dropdown-item-modern text-danger">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <h4 class="empty-title">Tidak Ada Laporan</h4>
                            <p class="empty-text">
                                Belum ada laporan yang sesuai dengan filter yang dipilih.
                                Coba ubah filter atau tunggu laporan baru dari pengguna.
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($reports->hasPages())
    <div class="pagination-container">
        {{ $reports->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<script>
// Add smooth transitions for status updates
document.querySelectorAll('form[action*="updateStatus"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        const button = this.querySelector('button');
        const originalText = button.innerHTML;

        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        button.disabled = true;

        // Re-enable after 3 seconds if form doesn't submit
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        }, 3000);
    });
});

// Add confirmation for status changes
document.querySelectorAll('form[action*="updateStatus"] button').forEach(button => {
    button.addEventListener('click', function(e) {
        const action = this.textContent.trim();
        if (!confirm(Yakin ingin $ {
                    action.toLowerCase()
                }
                laporan ini ? )) {
            e.preventDefault();
        }
    });
});

// Auto-refresh every 30 seconds for real-time updates
setInterval(() => {
    if (document.visibilityState === 'visible') {
        // Only refresh if page is visible
        const currentUrl = new URL(window.location);
        fetch(currentUrl.href)
            .then(response => response.text())
            .then(html => {
                // Update only the stats cards
                const parser = new DOMParser();
                const newDoc = parser.parseFromString(html, 'text/html');
                const newStats = newDoc.querySelector('.stats-grid');
                const currentStats = document.querySelector('.stats-grid');
                if (newStats && currentStats) {
                    currentStats.innerHTML = newStats.innerHTML;
                }
            })
            .catch(console.error);
    }
}, 30000);
</script>
@endsection