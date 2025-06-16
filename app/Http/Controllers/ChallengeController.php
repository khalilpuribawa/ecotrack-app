<?php

namespace App\Http\Controllers;

// Kumpulan semua 'use' yang dibutuhkan, tanpa duplikat.
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    /**
     * Menampilkan daftar semua tantangan yang tersedia untuk pengguna.
     */
    public function index()
    {
        $challenges = Challenge::latest()->paginate(10);
        return view('challenges.index', compact('challenges'));
    }

    /**
     * Menampilkan detail satu tantangan dan status partisipasi pengguna saat ini.
     */
    public function show(Challenge $challenge)
    {
        $user = Auth::user();
        // Cek status partisipasi pengguna pada tantangan ini
        $participation = $user->challenges()->where('challenge_id', $challenge->id)->first();
        
        return view('challenges.show', compact('challenge', 'participation'));
    }
    
    /**
     * Mendaftarkan pengguna untuk mengikuti sebuah tantangan.
     */
    public function participate(Request $request, Challenge $challenge)
    {
        $user = Auth::user();

        // Cek jika pengguna sudah pernah ikut tantangan ini sebelumnya
        if ($user->challenges()->where('challenge_id', $challenge->id)->exists()) {
            return back()->with('error', 'Anda sudah mengikuti tantangan ini.');
        }

        // Daftarkan pengguna ke tantangan dengan status 'joined'
        $user->challenges()->attach($challenge->id, ['status' => 'joined']);
        
        return redirect()->route('challenges.show', $challenge)->with('success', 'Anda berhasil bergabung dengan tantangan!');
    }

    /**
     * Menerima dan memproses bukti yang di-submit oleh pengguna.
     */
    public function submitProof(Request $request, Challenge $challenge)
    {
        // 1. Validasi input: pastikan yang di-upload adalah gambar.
        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000', 
        ]);

        // 2. Dapatkan pengguna yang sedang login.
        $user = Auth::user();

        // 3. Simpan file yang di-upload ke 'storage/app/public/proofs'.
        $path = $request->file('proof_image')->store('proofs', 'public');

        // 4. Update data di tabel pivot (challenge_participants).
        $user->challenges()->updateExistingPivot($challenge->id, [
            'status' => 'submitted',
            'submitted_proof' => $path, // Simpan path file yang sudah di-upload
            'submitted_at' => now(),    // Catat waktu submit
        ]);

        // 5. Arahkan kembali pengguna dengan pesan sukses.
        return back()->with('success', 'Bukti berhasil di-submit! Mohon tunggu review dari admin.');
    }

} // <- Ini adalah penutup dari 'class ChallengeController'