<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    // Menampilkan daftar semua komunitas
    public function index()
    {
        $communities = Community::with('creator')->withCount('members')->latest()->paginate(10);
        return view('communities.index', compact('communities'));
    }

    // Menampilkan form untuk membuat komunitas
    public function create()
    {
        return view('communities.create');
    }

    // Menyimpan komunitas baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:communities',
            'description' => 'required|string|max:1000',
        ]);

        $community = Community::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);
        
        // Otomatis jadikan pembuat sebagai admin komunitas
        $community->members()->attach(Auth::id(), ['role' => 'admin']);

        return redirect()->route('communities.show', $community)->with('success', 'Komunitas berhasil dibuat!');
    }

    // Menampilkan detail satu komunitas
    public function show(Community $community)
    {
        // Eager load relasi untuk performa
        $community->load('creator', 'members');
        
        // Cek apakah user yang sedang login adalah anggota
        $isMember = Auth::user()->communities()->where('community_id', $community->id)->exists();

        return view('communities.show', compact('community', 'isMember'));
    }

    // Logika untuk user bergabung ke komunitas
    public function join(Community $community)
    {
        // Cek agar tidak join dua kali
        if (!Auth::user()->communities()->where('community_id', $community->id)->exists()) {
            $community->members()->attach(Auth::id(), ['role' => 'member']);
            return back()->with('success', 'Anda berhasil bergabung dengan komunitas ' . $community->name);
        }
        return back()->with('error', 'Anda sudah menjadi anggota komunitas ini.');
    }
    
    // Logika untuk user keluar dari komunitas
    public function leave(Community $community)
    {
        // Pembuat komunitas tidak bisa keluar
        if ($community->created_by == Auth::id()) {
            return back()->with('error', 'Anda adalah pembuat komunitas ini dan tidak bisa keluar.');
        }

        Auth::user()->communities()->detach($community->id);
        return back()->with('success', 'Anda telah keluar dari komunitas ' . $community->name);
    }
}