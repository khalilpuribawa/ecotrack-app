<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Models\GreenPoint;
use App\Models\Challenge;

class DashboardController extends Controller
{
    // Di dalam file app/Http/Controllers/Admin/DashboardController.php

public function index()
{
    $stats = [
        'total_users' => User::count(),
        'pending_reports' => Report::where('status', 'pending')->count(),
        'pending_green_points' => GreenPoint::where('verified', false)->count(),

        // --- UBAH LOGIKA INI ---
        'active_challenges' => Challenge::where('start_date', '<=', now())
                                        ->where('end_date', '>=', now())
                                        ->count(),
    ];
    
    return view('admin.dashboard', compact('stats'));
}
}