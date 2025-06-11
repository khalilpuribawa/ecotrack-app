<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    // Menampilkan daftar semua tantangan
    public function index()
    {
        $challenges = Challenge::latest()->paginate(10);
        return view('challenges.index', compact('challenges'));
    }

    // Menampilkan detail tantangan dan status partisipasi user
    public function show(Challenge $challenge)
    {
        $user = Auth::user();
        $participation = $user->challenges()->where('challenge_id', $challenge->id)->first();
        return view('challenges.show', compact('challenge', 'participation'));
    }
    
    // Logika untuk user ikut tantangan
    public function participate(Request $request, Challenge $challenge)
    {
        $user = Auth::user();

        // Cek jika user sudah ikut
        if ($user->challenges()->where('challenge_id', $challenge->id)->exists()) {
            return back()->with('error', 'Anda sudah mengikuti tantangan ini.');
        }

        // Tambahkan user ke tantangan
        $user->challenges()->attach($challenge->id, ['status' => 'joined']);
        
        // Contoh logika sederhana saat user menyelesaikan challenge
        // Di aplikasi nyata, ini butuh verifikasi (misal upload bukti)
        // Setelah verifikasi, status diubah menjadi 'completed' dan poin ditambah.
        // Misalnya, ada fitur 'Selesaikan Tantangan':
        // $user->challenges()->updateExistingPivot($challenge->id, ['status' => 'completed']);
        // $user->points()->increment('total_points', $challenge->point_reward);

        return redirect()->route('challenges.show', $challenge)->with('success', 'Anda berhasil bergabung dengan tantangan!');
    }
}