<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan daftar laporan dengan filter status dan paginasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Memuat laporan beserta informasi user yang melaporkan, diurutkan berdasarkan terbaru.
        $query = Report::with('user')->latest();

        // Menerapkan filter status jika ada di request.
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Mengambil laporan dengan paginasi.
        $reports = $query->paginate(15);

        // Mengirimkan data laporan ke view 'admin.reports.index'.
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Menampilkan detail laporan tertentu.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\View\View
     */
    

    /**
     * Memperbarui status laporan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Report $report)
    {
        // Memvalidasi request status.
        $request->validate(['status' => 'required|in:verified,resolved,rejected']);

        // Memperbarui status laporan.
        $report->status = $request->status;
        $report->save();

        // Mengarahkan kembali dengan pesan sukses.
        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }
    public function show(Report $report) // <-- Metode 'show' yang hilang
    {
        // Mengirimkan data laporan ke view 'admin.reports.show'.
        // Pastikan Anda memiliki file resources/views/admin/reports/show.blade.php
        return view('admin.reports.show', compact('report'));
    }
    /**
     * Menghapus laporan.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Report $report)
    {
        // Hapus file gambar jika ada
        if ($report->image) {
            // Menggunakan Storage Facade untuk menghapus gambar dari disk 'public'.
            \Illuminate\Support\Facades\Storage::disk('public')->delete($report->image);
        }
        
        // Menghapus laporan dari database.
        $report->delete();

        // Mengarahkan kembali dengan pesan sukses.
        return back()->with('success', 'Laporan berhasil dihapus.');
    }
}