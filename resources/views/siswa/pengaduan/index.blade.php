<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Saya - Dashboard Siswa</title>
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
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .page-title {
            color: #1976d2;
            font-size: 1.8rem;
        }
        .btn-create {
            padding: 0.8rem 1.5rem;
            background: #1976d2;
            color: #fff;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 600;
        }
        .btn-create:hover {
            background: #1565c0;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .table-container {
            background: #fff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        table th {
            background: #f5f5f5;
            color: #1976d2;
            font-weight: 600;
        }
        table tbody tr:hover {
            background: #f9f9f9;
        }
        .no-data {
            text-align: center;
            color: #999;
            padding: 2rem;
        }
        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-proses { background: #cce5ff; color: #004085; }
        .badge-selesai { background: #d4edda; color: #155724; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Pengaduan Siswa</div>
        <nav>
            <a href="{{ route('siswa.dashboard') }}">Dashboard</a>
            <a href="{{ route('siswa.pengaduan.index') }}" class="active">Laporan Saya</a>
            <a href="#">Profil</a>
        </nav>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Laporan Pengaduan Saya</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="content">
            <div class="page-header">
                <h2 class="page-title">Daftar Laporan</h2>
                <a href="{{ route('siswa.pengaduan.create') }}" class="btn-create">+ Buat Laporan</a>
            </div>

            @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
            @endif
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Isi Laporan</th>
                            <th>Tanggapan Admin</th>
                            <th>Status</th>
                            <th>Jam (HH:MM)</th>
                            <th>Tanggal (YYYY-MM-DD)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ Str::limit($item->isi_laporan, 50) }}</td>
                            <td>
                                @if($item->tanggapan)
                                    {{ Str::limit($item->tanggapan, 50) }}
                                @else
                                    <em style="color:#999">Belum ada tanggapan</em>
                                @endif
                            </td>
                            <td>
                                @if($item->status == 'pending')
                                    <span class="badge badge-pending">Menunggu</span>
                                @elseif($item->status == 'proses')
                                    <span class="badge badge-proses">Diproses</span>
                                @else
                                    <span class="badge badge-selesai">Selesai</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('H:i') }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="no-data">Anda belum membuat laporan pengaduan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
