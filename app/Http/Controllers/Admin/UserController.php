<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class UserController extends Controller
{
    // app/Http/Controllers/Admin/UserController.php

public function index()
{
    try {
        // Kita coba jalankan query yang menyebabkan error di sini
        $users = \App\Models\User::latest()->paginate(10);
        
        // Jika baris di atas berhasil, kita akan menampilkan view
        // (Seharusnya tidak sampai ke sini)
        return view('admin.users.index', compact('users'));

    } catch (\Illuminate\Database\Eloquent\RelationNotFoundException $e) {
        
        // JIKA ERROR TERJADI, KODE INI YANG AKAN DIJALANKAN
        // Kita hentikan semua proses dan tampilkan detail lengkap dari errornya.
        // Ini akan memberi kita semua petunjuk yang kita butuhkan.
        dd($e); 
    }
}

    public function create()
    {
        // Cukup kembalikan view yang akan kita buat selanjutnya
        return view('admin.users.create');
    }
    
    public function updateRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:user,admin']);
        
        // Jangan biarkan admin terakhir menghapus rolenya sendiri
        if ($user->id === auth()->id() && $request->role === 'user') {
            return back()->with('error', 'Anda tidak bisa mengubah role Anda sendiri.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role pengguna berhasil diperbarui.');
    }

    public function store(Request $request)
{
    // 1. Validasi semua data yang masuk dari form
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:user,admin'],
    ]);

    // 2. Jika validasi berhasil, buat user baru
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Enkripsi password
        'role' => $request->role,
        'points' => 0, // Beri poin awal 0
    ]);

    // 3. Arahkan kembali ke halaman daftar dengan pesan sukses
    return redirect()->route('admin.users.index')
                     ->with('success', 'Pengguna baru berhasil ditambahkan.');
}
}