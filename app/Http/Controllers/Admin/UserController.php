<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('points')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
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
}