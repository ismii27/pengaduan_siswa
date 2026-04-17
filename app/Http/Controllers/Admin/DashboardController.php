<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Pengaduan Keseluruhan
        $totalPengaduan = Pengaduan::count();
        $menunggu = Pengaduan::where('status', 'pending')->count();
        $diproses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        // 2. Daftar Pengaduan Terbaru (Tabel)
        $pengaduanTerbaru = Pengaduan::select('id', 'judul', 'is_anonim', 'nama_siswa', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'pengaduanTerbaru'
        ));
    }
}
