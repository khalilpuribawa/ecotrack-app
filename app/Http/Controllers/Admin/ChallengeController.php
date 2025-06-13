<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChallengeController extends Controller
{
    // ... (method index, create, store, edit, update, destroy yang sudah ada) ...

    /**
     * Menampilkan daftar submission untuk sebuah tantangan.
     */

      public function index()
    {
        // 1. Ambil semua data tantangan dari database, urutkan dari yang terbaru.
        $challenges = Challenge::latest()->paginate(10); // paginate(10) untuk membatasi 10 data per halaman

        // 2. Kirim data tersebut ke file view untuk tabel admin.
        // Anda perlu membuat file view ini: resources/views/admin/challenges/index.blade.php
        return view('admin.challenges.index', compact('challenges'));
    }
public function create()
    {
        // Method ini hanya bertugas menampilkan file view form.
        return view('admin.challenges.create');
    }

    /**
     * Menyimpan tantangan yang baru dibuat ke database.
     * Mengarah ke rute: admin.challenges.store
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input dari form
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:challenges,title',
            'description' => 'required|string',
            'point_reward' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'badge' => 'nullable|string|max:50',
        ]);

        // 2. Jika validasi berhasil, buat data baru di database
        Challenge::create($validatedData);

        // 3. Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('admin.challenges.index')
                         ->with('success', 'Tantangan baru berhasil dibuat!');
    }

     public function reviewSubmissions(Challenge $challenge)
    {
        $submissions = $challenge->participants()
                                 ->wherePivot('status', 'submitted')
                                 ->orderBy('submitted_at', 'asc') // Urutkan dari yang paling lama submit
                                 ->paginate(10);

        return view('admin.challenges.review', compact('challenge', 'submissions'));
    }

    /**
     * Menyetujui submission, menambah poin, dan mengubah status.
     */
    public function approveSubmission(Request $request, Challenge $challenge, User $user)
    {
        DB::beginTransaction();
        try {
            // Update status di pivot
            $user->challenges()->updateExistingPivot($challenge->id, ['status' => 'completed']);
            // Tambah poin ke user
            $user->increment('points', $challenge->point_reward);
            DB::commit();
            return back()->with('success', "Submission dari {$user->name} berhasil disetujui.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses: ' . $e->getMessage());
        }
    }

    /**
     * Menolak submission dan memberikan feedback.
     */
    public function rejectSubmission(Request $request, Challenge $challenge, User $user)
    {
        $request->validate(['admin_feedback' => 'nullable|string|max:500']);
        
        $user->challenges()->updateExistingPivot($challenge->id, [
            'status' => 'rejected',
            'admin_feedback' => $request->admin_feedback,
        ]);
        
        return back()->with('success', "Submission dari {$user->name} telah ditolak.");
    }

    public function destroy(string $id)
{
    // 1. Cari tantangan berdasarkan ID yang dikirim.
    // Gunakan findOrFail agar otomatis error 404 jika ID tidak ditemukan.
    $challenge = \App\Models\Challenge::findOrFail($id);

    // 2. Hapus data tersebut dari database.
    $challenge->delete();

    // 3. Arahkan kembali ke halaman index dengan pesan sukses.
    return redirect()->route('admin.challenges.index')
                     ->with('success', 'Tantangan berhasil dihapus.');
}
}