<?php

namespace App\Http\Controllers;

use App\Models\GreenPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GreenPointController extends Controller
{
    // Menampilkan peta hijau
    public function index()
    {
        $greenPoints = GreenPoint::where('verified', true)->get();
        return view('green_points.index', compact('greenPoints'));
    }

    // Form untuk menambahkan titik hijau baru
    public function create()
    {
        return view('green_points.create');
    }

    // Menyimpan titik hijau baru
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        GreenPoint::create([
            'added_by' => Auth::id(),
            'type' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            // 'verified' defaultnya false, butuh persetujuan admin
        ]);

        return redirect()->route('green-map.index')->with('success', 'Titik hijau berhasil ditambahkan dan menunggu verifikasi.');
    }
}
