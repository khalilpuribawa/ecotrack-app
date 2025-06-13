<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\Report; // Asumsi Anda ingin menampilkan laporan terakhir juga
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Di dalam file app/Http/Controllers/DashboardController.php

// Di dalam file app/Http/Controllers/DashboardController.php

public function index()
{
    $user = auth()->user();

    // --- UBAH BAGIAN INI ---
    // Ambil 5 laporan terakhir milik pengguna ini
    $myReports = \App\Models\Report::where('user_id', $user->id)
                                   ->latest() // Urutkan dari yang terbaru
                                   ->take(5)  // Ambil 5 saja
                                   ->get();

    $activeChallenges = \App\Models\Challenge::where('start_date', '<=', now())
                                             ->where('end_date', '>=', now())
                                             ->latest()
                                             ->get();

    $points = $user->userPoint->points ?? 0;

    // --- DAN PERBAIKI JUGA DI SINI ---
    return view('dashboard', [
        'user' => $user,
        'points' => $points,
        'myReports' => $myReports, // Kirim variabel dengan nama $myReports
        'activeChallenges' => $activeChallenges,
    ]);
}
}