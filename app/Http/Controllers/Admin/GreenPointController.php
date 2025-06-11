<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GreenPoint;
use Illuminate\Http\Request;

class GreenPointController extends Controller
{
    public function index(Request $request)
    {
        $query = GreenPoint::with('addedBy')->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('verified', $request->status === 'verified');
        }
        
        $greenPoints = $query->paginate(15);
        return view('admin.green-points.index', compact('greenPoints'));
    }

    public function updateStatus(Request $request, GreenPoint $greenPoint)
    {
        $request->validate(['status' => 'required|in:1,0']); // 1 for verified, 0 for not
        
        $greenPoint->verified = $request->status;
        $greenPoint->save();
        
        return back()->with('success', 'Status titik hijau berhasil diperbarui.');
    }
    
    public function destroy(GreenPoint $greenPoint)
    {
        $greenPoint->delete();
        return back()->with('success', 'Titik hijau berhasil dihapus.');
    }
}