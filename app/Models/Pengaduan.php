<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    
    protected $fillable = [
        'id_user',
        'is_anonim',
        'nama_siswa',
        'kelas',
        'jenis_perundungan',
        'pelaku',
        'lokasi_kejadian',
        'judul',
        'isi_laporan',
        'foto',
        'status',
        'tanggapan',
        'tanggal_lapor'
    ];

    protected $casts = [
        'tanggal_lapor' => 'date'
    ];
}
