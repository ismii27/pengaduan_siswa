<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
        .welcome-card {
            background: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .welcome-card h2 {
            color: #1976d2;
            margin-bottom: 0.5rem;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .stat-card h3 {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        .stat-card .number {
            color: #1976d2;
            font-size: 2rem;
            font-weight: 700;
        }
        .table-container {
            background: #fff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .table-container h3 {
            color: #1976d2;
            margin-bottom: 1rem;
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
        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-proses { background: #cce5ff; color: #004085; }
        .badge-selesai { background: #d4edda; color: #155724; }
        
        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; flex-direction: row; flex-wrap: wrap; justify-content: space-between; align-items: center; padding: 1rem; min-height: auto; }
            .sidebar .logo { margin-bottom: 0; }
            .sidebar nav { display: flex; flex-wrap: wrap; gap: 0.5rem; width: 100%; margin-top: 1rem; }
            .sidebar nav a { flex: 1; text-align: center; }
            .table-container { overflow-x: auto; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('admin.pengaduan.index') }}">Laporan Pengaduan</a>
            <a href="{{ route('admin.siswa.index') }}">Data Siswa</a>
            <a href="{{ route('admin.settings.index') }}">Pengaturan</a>
        </nav>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Dashboard Admin</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="content">
            <div class="welcome-card">
                <h2>Selamat Datang, {{ Auth::user()->nama }}!</h2>
                <p>Anda login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Pengaduan</h3>
                    <div class="number">{{ $totalPengaduan }}</div>
                </div>
                <div class="stat-card">
                    <h3>Menunggu</h3>
                    <div class="number">{{ $menunggu }}</div>
                </div>
                <div class="stat-card">
                    <h3>Diproses</h3>
                    <div class="number">{{ $diproses }}</div>
                </div>
                <div class="stat-card">
                    <h3>Selesai</h3>
                    <div class="number">{{ $selesai }}</div>
                </div>
            </div>

            <div class="table-container">
                <h3>Pengaduan Terbaru</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduanTerbaru as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->is_anonim ? 'Anonim' : ($item->nama_siswa ?? 'Siswa') }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                @if($item->status == 'pending')
                                    <span class="badge badge-pending">Menunggu</span>
                                @elseif($item->status == 'proses')
                                    <span class="badge badge-proses">Diproses</span>
                                @else
                                    <span class="badge badge-selesai">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align:center; color:#999;">Belum ada data pengaduan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
