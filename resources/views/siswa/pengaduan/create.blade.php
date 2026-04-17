<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - Dashboard Siswa</title>
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
            min-height: 120px;
        }
        .form-group input[type="file"] {
            padding: 0.5rem;
        }
        .radio-group {
            display: flex;
            gap: 1.5rem;
        }
        .radio-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: normal;
            color: #333;
        }
        .form-help {
            font-size: 0.85rem;
            color: #666;
            margin-top: 0.3rem;
        }
        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .btn-submit {
            padding: 0.8rem 2rem;
            background: #1976d2;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
        }
        .btn-submit:hover {
            background: #1565c0;
        }
        .btn-cancel {
            padding: 0.8rem 2rem;
            background: #999;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
        }
        .btn-cancel:hover {
            background: #777;
        }
        .required {
            color: #d32f2f;
        }
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
            <h1>Buat Laporan Pengaduan</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="content">
            <h2 class="page-title">Form Laporan Pengaduan</h2>
            
            <div class="form-container">
                <form method="POST" action="{{ route('siswa.pengaduan.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label>Opsi Laporan <span class="required">*</span></label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="is_anonim" value="1" required> Anonim
                            </label>
                            <label>
                                <input type="radio" name="is_anonim" value="0" required> Tidak Anonim
                            </label>
                        </div>
                        <div class="form-help">Pilih anonim jika tidak ingin identitas ditampilkan</div>
                    </div>

                    <div class="form-group" id="nama-group">
                        <label for="nama_siswa">Nama Siswa <span class="required">*</span></label>
                        <input type="text" id="nama_siswa" name="nama_siswa" value="{{ Auth::user()->nama }}">
                        <div class="form-help">Akan disembunyikan jika memilih anonim</div>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas <span class="required">*</span></label>
                        <input type="text" id="kelas" name="kelas" placeholder="Contoh: XII RPL 1" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_perundungan">Jenis Perundungan <span class="required">*</span></label>
                        <select id="jenis_perundungan" name="jenis_perundungan" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Cyberbullying">Cyberbullying</option>
                            <option value="Bullying Verbal">Bullying Verbal</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pelaku">Pelaku <span class="required">*</span></label>
                        <select id="pelaku" name="pelaku" required>
                            <option value="">-- Pilih Pelaku --</option>
                            <option value="Siswa">Siswa</option>
                            <option value="Bukan Siswa">Bukan Siswa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lokasi_kejadian">Lokasi Kejadian <span class="required">*</span></label>
                        <input type="text" id="lokasi_kejadian" name="lokasi_kejadian" placeholder="Contoh: Kelas 11 RPL 1" required>
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul Laporan <span class="required">*</span></label>
                        <input type="text" id="judul" name="judul" placeholder="Judul singkat laporan" required>
                    </div>

                    <div class="form-group">
                        <label for="isi_laporan">Isi Laporan / Deskripsi Kejadian <span class="required">*</span></label>
                        <textarea id="isi_laporan" name="isi_laporan" placeholder="Jelaskan kronologi kejadian secara detail..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="foto">Upload Foto Bukti</label>
                        <input type="file" id="foto" name="foto" accept="image/*">
                        <div class="form-help">Format: JPG, PNG (Max: 2MB) - Opsional</div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn-submit">Kirim Laporan</button>
                        <a href="{{ route('siswa.pengaduan.index') }}" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle nama siswa field based on anonim selection
        const anonimRadios = document.querySelectorAll('input[name="is_anonim"]');
        const namaGroup = document.getElementById('nama-group');
        const namaInput = document.getElementById('nama_siswa');

        anonimRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === '1') {
                    namaInput.removeAttribute('required');
                    namaGroup.style.opacity = '0.5';
                } else {
                    namaInput.setAttribute('required', 'required');
                    namaGroup.style.opacity = '1';
                }
            });
        });
    </script>
</body>
</html>
