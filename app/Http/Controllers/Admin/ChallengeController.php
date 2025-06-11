<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Jika model Challenge ada di namespace App\Models, tambahkan ini di atas:
use App\Models\Challenge; 

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua data dari model Challenge.
        $challenges = Challenge::latest()->paginate(10); // Mengambil data terbaru, 10 per halaman

        // 2. Kirim data tersebut ke file view yang sesuai.
        // File ini harus Anda buat di: resources/views/admin/challenges/index.blade.php
        return view('admin.challenges.index', compact('challenges'));
    }

    // ... method lain biarkan kosong untuk saat ini ...
}