<?php

use Illuminate\Support\Facades\Route;

// === CONTROLLERS UNTUK PENGGUNA UMUM ===
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\GreenPointController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommunityController;

// === CONTROLLERS UNTUK PANEL ADMIN ===
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\GreenPointController as AdminGreenPointController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ChallengeController as AdminChallengeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CommunityController as AdminCommunityController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute untuk seluruh aplikasi EcoTrack.ID.
|
*/

// =========================================================================
// == RUTE PUBLIK (DAPAT DIAKSES TANPA LOGIN)
// =========================================================================


// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Autentikasi (Login & Register)
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Fitur Edukasi & Artikel (Publik)
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');


// =========================================================================
// == RUTE YANG MEMERLUKAN AUTENTIKASI (PENGGUNA SUDAH LOGIN)
// =========================================================================

Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard Pengguna
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- Fitur 1: Lapor Lingkungan ---
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');

    // --- Fitur 2: Eco-Challenge ---
    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('/challenges/{challenge}', [ChallengeController::class, 'show'])->name('challenges.show');
    Route::post('/challenges/{challenge}/participate', [ChallengeController::class, 'participate'])->name('challenges.participate');
    Route::post('/challenges/{challenge}/submit', [ChallengeController::class, 'submitProof'])->name('challenges.submitProof');
    
    // --- Fitur 3: Peta Hijau Komunitas ---
    Route::get('/green-map', [GreenPointController::class, 'index'])->name('green-map.index');
    Route::get('/green-map/create', [GreenPointController::class, 'create'])->name('green-map.create');
    Route::post('/green-map', [GreenPointController::class, 'store'])->name('green-map.store');
    
    // --- Fitur 5: Komunitas ---
    Route::get('/communities', [CommunityController::class, 'index'])->name('communities.index');
    Route::get('/communities/create', [CommunityController::class, 'create'])->name('communities.create');
    Route::post('/communities', [CommunityController::class, 'store'])->name('communities.store');
    Route::get('/communities/{community}', [CommunityController::class, 'show'])->name('communities.show');
    Route::post('/communities/{community}/join', [CommunityController::class, 'join'])->name('communities.join');
    Route::post('/communities/{community}/leave', [CommunityController::class, 'leave'])->name('communities.leave');
});


// =========================================================================
// == PANEL ADMIN (MEMERLUKAN LOGIN DAN ROLE 'ADMIN')
// =========================================================================

Route::middleware(['auth', \App\Http\Middleware\CheckIfAdmin::class])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Laporan
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::post('/reports/{report}/update-status', [AdminReportController::class, 'updateStatus'])->name('reports.updateStatus');
    Route::delete('/reports/{report}', [AdminReportController::class, 'destroy'])->name('reports.destroy');

    // Manajemen Titik Hijau
    Route::get('/green-points', [AdminGreenPointController::class, 'index'])->name('green-points.index');
    Route::post('/green-points/{greenPoint}/update-status', [AdminGreenPointController::class, 'updateStatus'])->name('green-points.updateStatus');
    Route::delete('/green-points/{greenPoint}', [AdminGreenPointController::class, 'destroy'])->name('green-points.destroy');
    
    // Manajemen Artikel (CRUD Penuh)
    Route::resource('articles', AdminArticleController::class)->except(['show']);
    
    // Manajemen Tantangan (CRUD Penuh)
    // ... di dalam grup admin ...
Route::resource('challenges', AdminChallengeController::class)->except(['show']);

// Rute untuk review dan approval
Route::get('/challenges/{challenge}/review', [AdminChallengeController::class, 'reviewSubmissions'])->name('challenges.review');
Route::post('/challenges/{challenge}/submissions/{user}/approve', [AdminChallengeController::class, 'approveSubmission'])->name('challenges.submissions.approve');
Route::post('/challenges/{challenge}/submissions/{user}/reject', [AdminChallengeController::class, 'rejectSubmission'])->name('challenges.submissions.reject');
    
    // Manajemen Pengguna
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/update-role', [AdminUserController::class, 'updateRole'])->name('users.updateRole');
      Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');

    // --- TAMBAHKAN DUA RUTE INI ---
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    
    Route::post('/users/{user}/update-role', [AdminUserController::class, 'updateRole'])->name('users.updateRole');
    
    // Manajemen Komunitas
    Route::get('/communities', [AdminCommunityController::class, 'index'])->name('communities.index');
    Route::delete('/communities/{community}', [AdminCommunityController::class, 'destroy'])->name('communities.destroy');
    
  
});

 Route::get('/tes-halaman-error', function () {
    return view('test');
});

// routes/web.php

// ... (semua rute Anda yang lain) ...


// ===== RUTE UNTUK DIAGNOSIS FINAL =====
Route::get('/tes-user-final', function () {
    echo "<h1>Mulai Diagnosis Final...</h1>";

    try {
        echo "<p>Mencoba mengambil data User dengan ID 1...</p>";

        // Kita coba ambil satu user saja dari database
        $user = \App\Models\User::find(1);

        if ($user) {
            echo "<p style='color:green; font-weight:bold;'>BERHASIL! Data user dengan ID 1 ditemukan.</p>";
            echo "<p>Ini artinya tidak ada masalah dengan Model User Anda.</p>";
            echo "<pre>";
            print_r($user->toArray());
            echo "</pre>";
        } else {
            echo "<p style='color:orange; font-weight:bold;'>User dengan ID 1 tidak ditemukan, tapi query berhasil dijalankan.</p>";
        }

    } catch (\Exception $e) {
        // Jika baris \App\Models\User::find(1) menghasilkan error, kita akan menangkapnya di sini.
        echo "<h2 style='color:red;'>ERROR DITEMUKAN!</h2>";
        echo "<p>Ini adalah sumber masalah yang kita cari selama ini.</p>";
        echo "<p><strong>Pesan Error:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>Terjadi di File:</strong> " . $e->getFile() . "</p>";
        echo "<p><strong>Pada Baris:</strong> " . $e->getLine() . "</p>";
        echo "<hr><h3>Jejak Lengkap (Stack Trace):</h3>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }

    echo "<h1>...Diagnosis Selesai.</h1>";
});