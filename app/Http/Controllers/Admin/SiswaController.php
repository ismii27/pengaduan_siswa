<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa dengan riwayat login
        // Menggunakan updated_at sebagai waktu login terakhir
        $siswa = User::where('role', 'siswa')
            ->select('nama', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.siswa.index', compact('siswa'));
    }
}
