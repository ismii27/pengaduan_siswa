<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Pengaduan - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #f5f5f5;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #1976d2;
            color: #fff;
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }
        .sidebar nav a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            transition: background 0.2s;
        }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: #1565c0;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background: #fff;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar h1 {
            color: #1976d2;
            font-size: 1.5rem;
        }
        .btn-logout {
            padding: 0.6rem 1.5rem;
            background: #d32f2f;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-logout:hover {
            background: #c62828;
        }
        .content {
            padding: 2rem;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }
        .card {
            background: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        .card-title {
            color: #1976d2;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .detail-row {
            display: flex;
            margin-bottom: 1rem;
        }
        .detail-label {
            width: 200px;
            font-weight: 600;
            color: #555;
        }
        .detail-value {
            flex: 1;
            color: #333;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
        }
        .form-group select, .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            font-size: 1rem;
        }
        .btn-primary {
            padding: 0.8rem 2rem;
            background: #1976d2;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
        }
        .btn-primary:hover {
            background: #1565c0;
        }
        .btn-secondary {
            padding: 0.8rem 2rem;
            background: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
        }
        .foto-bukti {
            max-width: 100%;
            border-radius: 0.5rem;
            border: 1px solid #ddd;
            margin-top: 0.5rem;
        }
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; flex-direction: row; flex-wrap: wrap; justify-content: space-between; align-items: center; padding: 1rem; }
            .sidebar nav { display: flex; flex-wrap: wrap; gap: 0.5rem; width: 100%; }
            .sidebar nav a { flex: 1; text-align: center; }
            .detail-row { flex-direction: column; }
            .detail-label { width: 100%; margin-bottom: 0.2rem; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.pengaduan.index') }}" class="active">Laporan Pengaduan</a>
            <a href="{{ route('admin.siswa.index') }}">Data Siswa</a>
            <a href="{{ route('admin.settings.index') }}">Pengaturan</a>
        </nav>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Detail Pengaduan</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="content">
            
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Informasi Laporan</div>
                    <a href="{{ route('admin.pengaduan.index') }}" class="btn-secondary">Kembali</a>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Tanggal Lapor</div>
                    <div class="detail-value">{{ $pengaduan->created_at->format('d M Y H:i') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Pelapor</div>
                    <div class="detail-value">{{ $pengaduan->is_anonim ? 'Anonim' : ($pengaduan->nama_siswa ?? 'Siswa (ID: '.$pengaduan->id_user.')') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Kelas</div>
                    <div class="detail-value">{{ $pengaduan->kelas ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Judul</div>
                    <div class="detail-value"><strong>{{ $pengaduan->judul }}</strong></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jenis Perundungan</div>
                    <div class="detail-value">{{ $pengaduan->jenis_perundungan ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Pelaku</div>
                    <div class="detail-value">{{ $pengaduan->pelaku ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Lokasi Kejadian</div>
                    <div class="detail-value">{{ $pengaduan->lokasi_kejadian ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Isi Laporan</div>
                    <div class="detail-value" style="background: #f9f9f9; padding: 1rem; border-radius: 0.5rem;">
                        {{ $pengaduan->isi_laporan }}
                    </div>
                </div>
                @if($pengaduan->foto)
                <div class="detail-row">
                    <div class="detail-label">Foto Bukti</div>
                    <div class="detail-value">
                        <img src="{{ asset($pengaduan->foto) }}" alt="Foto Bukti" class="foto-bukti">
                    </div>
                </div>
                @endif
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tindak Lanjut Admin</div>
                </div>
                
                <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Status Laporan</label>
                        <select name="status" required>
                            <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                            <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggapan / Deskripsi Tambahan</label>
                        <textarea name="tanggapan" rows="5" placeholder="Tuliskan tanggapan atau tindakan yang telah diambil...">{{ $pengaduan->tanggapan }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary">Simpan Pembaruan</button>
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>