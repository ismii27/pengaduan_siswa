<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan - Admin</title>
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
        .page-title {
            color: #1976d2;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
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
        .isi-laporan {
            max-width: 400px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
            <h1>Laporan Pengaduan Anonim</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="content">
            <h2 class="page-title">Data Laporan Pengaduan</h2>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th>Jam (HH:MM)</th>
                            <th>Tanggal (YYYY-MM-DD)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->is_anonim ? 'Anonim' : ($item->nama_siswa ?? 'Siswa') }}</td>
                            <td>
                                @if($item->status == 'pending')
                                    <span class="badge badge-pending" style="background: #fff3cd; color: #856404; padding: 0.3rem 0.8rem; border-radius: 1rem; font-size: 0.85rem; font-weight: 600;">Menunggu</span>
                                @elseif($item->status == 'proses')
                                    <span class="badge badge-proses" style="background: #cce5ff; color: #004085; padding: 0.3rem 0.8rem; border-radius: 1rem; font-size: 0.85rem; font-weight: 600;">Diproses</span>
                                @else
                                    <span class="badge badge-selesai" style="background: #d4edda; color: #155724; padding: 0.3rem 0.8rem; border-radius: 1rem; font-size: 0.85rem; font-weight: 600;">Selesai</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('H:i') }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin.pengaduan.show', $item->id) }}" style="padding: 0.4rem 0.8rem; background: #1976d2; color: #fff; text-decoration: none; border-radius: 0.3rem; font-size: 0.9rem;">Detail & Tindakan</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="no-data">Belum ada data pengaduan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
