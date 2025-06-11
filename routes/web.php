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
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('admin.reports.show');
    Route::post('/reports/{report}/update-status', [AdminReportController::class, 'updateStatus'])->name('reports.updateStatus');
    Route::delete('/reports/{report}', [AdminReportController::class, 'destroy'])->name('reports.destroy');

    // Manajemen Titik Hijau
    Route::get('/green-points', [AdminGreenPointController::class, 'index'])->name('green-points.index');
    Route::post('/green-points/{greenPoint}/update-status', [AdminGreenPointController::class, 'updateStatus'])->name('green-points.updateStatus');
    Route::delete('/green-points/{greenPoint}', [AdminGreenPointController::class, 'destroy'])->name('green-points.destroy');
    
    // Manajemen Artikel (CRUD Penuh)
    Route::resource('articles', AdminArticleController::class)->except(['show']);
    
    // Manajemen Tantangan (CRUD Penuh)
    Route::resource('challenges', AdminChallengeController::class)->except(['show']);
    
    // Manajemen Pengguna
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/update-role', [AdminUserController::class, 'updateRole'])->name('users.updateRole');
    
    // Manajemen Komunitas
    Route::get('/communities', [AdminCommunityController::class, 'index'])->name('communities.index');
    Route::delete('/communities/{community}', [AdminCommunityController::class, 'destroy'])->name('communities.destroy');
    
  
});

 Route::get('/tes-halaman-error', function () {
    return view('test');
});