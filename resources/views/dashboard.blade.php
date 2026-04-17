<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            background: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 220px;
            background: #1976d2;
            color: #fff;
            min-height: 100vh;
            padding: 2rem 1rem;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 2rem;
            text-align: center;
        }
        .sidebar nav a {
            display: block;
            color: #fff;
            text-decoration: none;
            font-size: 1.08rem;
            padding: 0.7rem 1rem;
            border-radius: 0.6rem;
            margin-bottom: 0.5rem;
            transition: background 0.2s;
        }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: #1565c0;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background: #1976d2;
            color: #fff;
            padding: 1.2rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 1.15rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .dashboard-greeting {
            color: #1976d2;
            font-size: 1.2rem;
            margin: 2rem 0 1.5rem 0;
            text-align: left;
        }
        .dashboard-table-container {
            flex: 1;
            padding: 2rem;
            background: #fff;
        }
        table.dashboard-table {
            width: 100%;
            border-collapse: collapse;
            background: #e3f2fd;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 2px 12px 0 rgba(33, 150, 243, 0.08);
        }
        table.dashboard-table th, table.dashboard-table td {
            padding: 1rem 1.2rem;
            text-align: left;
        }
        table.dashboard-table th {
            background: #1976d2;
            color: #fff;
            font-weight: 600;
            font-size: 1.08rem;
            border-bottom: 2px solid #1565c0;
        }
        table.dashboard-table td {
            color: #1565c0;
            font-size: 1.05rem;
            border-bottom: 1px solid #bbdefb;
        }
        .btn-logout {
            padding: 0.5rem 1.5rem;
            background: #1976d2;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-left: 1rem;
        }
        .btn-logout:hover {
            background: #1565c0;
        }
        @media (max-width: 900px) {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
            }
        }
        @media (max-width: 600px) {
            .dashboard-table-container {
                padding: 0.5rem;
            }
            .navbar {
                padding: 1rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Pengaduan Siswa</div>
        <nav>
            <a href="#" class="active">Laporan Pengaduan Siswa</a>
        </nav>
    </div>
    <div class="main-content">
        <div class="navbar">
            Dashboard
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="dashboard-greeting">
            Halo, <b>{{ Auth::user()->nama }}</b>! Selamat datang di dashboard.
        </div>
        <div class="dashboard-table-container">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Isi Laporan</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis, ganti dengan data dinamis jika sudah ada -->
                    <tr>
                        <td>Laporan 1</td>
                        <td>Isi laporan siswa bersifat anonim atau tidak.</td>
                        <td>{{ Auth::user()->role }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
