<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Admin</title>
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
        .form-container {
            background: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 800px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-family: inherit;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-group input[type="file"] {
            padding: 0.5rem;
        }
        .logo-preview {
            margin-top: 1rem;
            max-width: 200px;
        }
        .logo-preview img {
            max-width: 100%;
            border-radius: 0.5rem;
            border: 2px solid #ddd;
        }
        .btn-save {
            padding: 0.8rem 2rem;
            background: #1976d2;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
        }
        .btn-save:hover {
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
        .form-help {
            font-size: 0.85rem;
            color: #666;
            margin-top: 0.3rem;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.pengaduan.index') }}">Laporan Pengaduan</a>
            <a href="{{ route('admin.siswa.index') }}">Data Siswa</a>
            <a href="{{ route('admin.settings.index') }}" class="active">Pengaturan</a>
        </nav>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Pengaturan Website</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="content">
            <h2 class="page-title">Pengaturan Umum</h2>
            
            @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
            @endif

            <div class="form-container">
                <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="site_name">Nama Website</label>
                        <input type="text" id="site_name" name="site_name" value="{{ $settings['site_name'] }}" required>
                        <div class="form-help">Nama website yang akan ditampilkan di header</div>
                    </div>

                    <div class="form-group">
                        <label for="site_description">Deskripsi Website</label>
                        <textarea id="site_description" name="site_description">{{ $settings['site_description'] }}</textarea>
                        <div class="form-help">Deskripsi singkat tentang website</div>
                    </div>

                    <div class="form-group">
                        <label for="site_logo">Logo Website</label>
                        <input type="file" id="site_logo" name="site_logo" accept="image/*">
                        <div class="form-help">Format: JPG, PNG, GIF (Max: 2MB)</div>
                        @if($settings['site_logo'])
                        <div class="logo-preview">
                            <img src="{{ asset($settings['site_logo']) }}" alt="Logo">
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="admin_contact">Kontak Admin</label>
                        <input type="text" id="admin_contact" name="admin_contact" value="{{ $settings['admin_contact'] }}" required>
                        <div class="form-help">Email atau nomor telepon admin</div>
                    </div>

                    <div class="form-group">
                        <label for="site_status">Status Website</label>
                        <select id="site_status" name="site_status" required>
                            <option value="aktif" {{ $settings['site_status'] == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ $settings['site_status'] == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <div class="form-help">Status operasional website</div>
                    </div>

                    <button type="submit" class="btn-save">Simpan Pengaturan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
