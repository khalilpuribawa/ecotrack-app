<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Challenge;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil beberapa data untuk ditampilkan di dashboard
        $myReports = Report::where('user_id', $user->id)->latest()->take(5)->get();
        $activeChallenges = Challenge::where('end_date', '>=', now())->get();
        
        return view('dashboard', compact('user', 'myReports', 'activeChallenges'));
    }
}