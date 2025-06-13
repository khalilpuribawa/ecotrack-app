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

     public function submitProof(Request $request, Challenge $challenge)
    {
        $request->validate([
            // Validasi file: harus gambar, tipe tertentu, ukuran maks 2MB
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $user = Auth::user();

        // 1. Simpan foto ke server di dalam folder 'public/proofs/challenges'
        // 'public' di sini merujuk ke storage disk.
        $path = $request->file('proof_image')->store('proofs/challenges', 'public');
        
        // Pastikan Anda sudah menjalankan `php artisan storage:link` sebelumnya

        // 2. Update data di pivot table (challenge_participants)
        $user->challenges()->updateExistingPivot($challenge->id, [
            'status' => 'submitted', // Ubah status menjadi 'submitted'
            'submitted_proof' => $path,
            'submitted_at' => now(),
        ]);

        return redirect()->route('challenges.show', $challenge)
                         ->with('success', 'Bukti berhasil disubmit! Mohon tunggu review dari admin.');
    }
}