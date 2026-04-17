<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // 1. Laporan Ringkasan KPI (Total, Menunggu, Diproses, Selesai)
        $totalPengaduan = Pengaduan::where('id_user', $userId)->count();
        $menunggu = Pengaduan::where('id_user', $userId)->where('status', 'pending')->count();
        $diproses = Pengaduan::where('id_user', $userId)->where('status', 'proses')->count();
        $selesai = Pengaduan::where('id_user', $userId)->where('status', 'selesai')->count();

        // 2. Laporan Daftar Pengaduan Terbaru (Tabel Terintegrasi)
        $pengaduanTerbaru = Pengaduan::where('id_user', $userId)
            ->select('id', 'judul', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'pengaduanTerbaru'
        ));
    }
}
