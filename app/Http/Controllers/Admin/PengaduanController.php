<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        // Ambil data pengaduan secara lengkap untuk admin
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->get();

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
            'tanggapan' => 'nullable|string'
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan
        ]);

        return redirect()->route('admin.pengaduan.index')->with('success', 'Status dan tanggapan pengaduan berhasil diperbarui!');
    }
}
