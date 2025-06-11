<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Menampilkan semua laporan di peta
    public function index()
    {
        $reports = Report::with('user')->where('status', 'verified')->get();
        return view('reports.index', compact('reports'));
    }

    // Menampilkan form untuk membuat laporan baru
    public function create()
    {
        return view('reports.create');
    }

    // Menyimpan laporan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|max:2048', // Maks 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        Report::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $imagePath,
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dikirim dan menunggu verifikasi.');
    }
    
    // Menampilkan detail satu laporan
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }
}