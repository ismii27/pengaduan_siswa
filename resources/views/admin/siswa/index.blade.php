<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Login Siswa - Admin</title>
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
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.pengaduan.index') }}">Laporan Pengaduan</a>
            <a href="{{ route('admin.siswa.index') }}" class="active">Data Siswa</a>
            <a href="{{ route('admin.settings.index') }}">Pengaturan</a>
        </nav>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Riwayat Login Siswa</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="content">
            <h2 class="page-title">Data Riwayat Login Siswa</h2>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Waktu Login</th>
                            <th>Tanggal Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->updated_at->format('H:i') }}</td>
                            <td>{{ $item->updated_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="no-data">Belum ada data riwayat login siswa</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
