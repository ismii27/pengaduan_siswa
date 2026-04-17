<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index()
    {
        // Ambil laporan pengaduan milik siswa yang login
        $pengaduan = Pengaduan::where('id_user', Auth::id())
            ->select('id', 'judul', 'isi_laporan', 'status', 'tanggapan', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        return view('siswa.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'is_anonim' => 'required|in:0,1',
            'nama_siswa' => 'required_if:is_anonim,0|nullable|string|max:255',
            'kelas' => 'required|string|max:50',
            'jenis_perundungan' => 'required|string',
            'pelaku' => 'required|string',
            'lokasi_kejadian' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'id_user' => Auth::id(),
            'is_anonim' => $request->is_anonim,
            'nama_siswa' => $request->is_anonim == 1 ? null : $request->nama_siswa,
            'kelas' => $request->kelas,
            'jenis_perundungan' => $request->jenis_perundungan,
            'pelaku' => $request->pelaku,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'status' => 'pending',
            'tanggal_lapor' => now()->toDateString()
        ];

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pengaduan'), $filename);
            $data['foto'] = 'uploads/pengaduan/' . $filename;
        }

        Pengaduan::create($data);

        return redirect()->route('siswa.pengaduan.index')->with('success', 'Laporan pengaduan berhasil dikirim!');
    }
}
