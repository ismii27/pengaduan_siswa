<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
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
            flex-shrink: 0;
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
            overflow-y: auto;
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
        .profile-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }
        .card {
            background: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card h3 {
            color: #1976d2;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 0.5rem;
        }
        .profile-picture {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #1976d2;
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
        .form-group input, .form-group textarea {
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
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: background 0.2s;
        }
        .btn-secondary:hover {
            background: #e0e0e0;
        }
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        .otp-group {
            display: flex;
            gap: 1rem;
        }
        .otp-group input { flex: 1; }
        
        /* Loading Spinner */
        .spinner {
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top: 3px solid #fff;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            margin-right: 8px;
            display: none;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .btn-loading .spinner { display: inline-block; }
        .btn-loading span { display: none; }

        @media (max-width: 900px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
            .sidebar {
                display: none; /* In real app, we'd have a mobile menu toggle */
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Profil Pengguna</div>
        <nav>
            @if($user->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                <a href="{{ route('admin.pengaduan.index') }}">Laporan Pengaduan</a>
                <a href="{{ route('admin.siswa.index') }}">Data Siswa</a>
                <a href="{{ route('admin.settings.index') }}">Pengaturan</a>
            @else
                <a href="{{ route('siswa.dashboard') }}">Dashboard Siswa</a>
                <a href="{{ route('siswa.pengaduan.index') }}">Laporan Saya</a>
            @endif
            <a href="{{ route('profile.index') }}" class="active">Profil</a>
        </nav>
    </div>
    
    <div class="main-content">
        <div class="navbar">
            <h1>Profil Saya</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin-left: 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="profile-container">
                <!-- Kolom Kiri: Foto & Password -->
                <div class="left-col">
                    <div class="card" style="margin-bottom: 2rem;">
                        <h3>Foto Profil</h3>
                        <div class="profile-picture">
                            <img src="{{ $user->foto_profil ? asset($user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($user->nama).'&background=1976d2&color=fff' }}" alt="Foto Profil">
                            
                            <form action="{{ route('profile.foto') }}" method="POST" enctype="multipart/form-data" id="formFoto">
                                @csrf
                                <input type="file" name="foto_profil" id="foto_profil" style="display:none" accept="image/*" onchange="document.getElementById('formFoto').submit();">
                                <button type="button" class="btn-secondary" onclick="document.getElementById('foto_profil').click();">Ubah Foto</button>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <h3>Ubah Kata Sandi</h3>
                        <form action="{{ route('profile.password') }}" method="POST" onsubmit="showLoading(this, 'btn-password')">
                            @csrf
                            <div class="form-group">
                                <label>Kata Sandi Saat Ini</label>
                                <input type="password" name="current_password" required>
                            </div>
                            <div class="form-group">
                                <label>Kata Sandi Baru</label>
                                <input type="password" name="password" required minlength="8">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation" required minlength="8">
                            </div>
                            <button type="submit" class="btn-primary" id="btn-password">
                                <div class="spinner"></div>
                                <span>Simpan Sandi</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Kolom Kanan: Informasi Profil & Email OTP -->
                <div class="right-col">
                    <div class="card" style="margin-bottom: 2rem;">
                        <h3>Informasi Dasar</h3>
                        <form action="{{ route('profile.update') }}" method="POST" onsubmit="showLoading(this, 'btn-profil')">
                            @csrf
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Username / NIS</label>
                                <input type="text" value="{{ $user->username }}" disabled style="background:#eee;">
                            </div>

                            @if($user->role === 'siswa')
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" name="no_telp" value="{{ old('no_telp', $user->siswa->no_telp ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <textarea name="alamat" rows="3">{{ old('alamat', $user->siswa->alamat ?? '') }}</textarea>
                                </div>
                            @endif

                            <button type="submit" class="btn-primary" id="btn-profil">
                                <div class="spinner"></div>
                                <span>Simpan Profil</span>
                            </button>
                        </form>
                    </div>

                    <div class="card">
                        <h3>Pengaturan Email</h3>
                        <div class="form-group">
                            <label>Email Saat Ini</label>
                            <input type="email" value="{{ $user->email ?? 'Belum diatur' }}" disabled style="background:#eee;">
                        </div>

                        <form id="formSendOtp" onsubmit="event.preventDefault(); sendOtp();">
                            <div class="form-group">
                                <label>Email Baru</label>
                                <div class="otp-group">
                                    <input type="email" id="new_email" name="email" required placeholder="Masukkan email baru">
                                    <button type="submit" class="btn-secondary" id="btn-send-otp">Kirim OTP</button>
                                </div>
                                <small id="otp-message" style="color:#1976d2; display:none; margin-top:0.5rem;"></small>
                            </div>
                        </form>

                        <form action="{{ route('profile.otp.verify') }}" method="POST" style="display: {{ session('otp_error') ? 'block' : 'none' }};" id="formVerifyOtp" onsubmit="showLoading(this, 'btn-verify')">
                            @csrf
                            <div class="form-group">
                                <label>Masukkan Kode OTP</label>
                                <div class="otp-group">
                                    <input type="text" name="otp" required maxlength="6" pattern="\d{6}" placeholder="6 digit angka">
                                    <button type="submit" class="btn-primary" id="btn-verify">
                                        <div class="spinner"></div>
                                        <span>Verifikasi & Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showLoading(form, btnId) {
            const btn = document.getElementById(btnId);
            btn.classList.add('btn-loading');
            btn.disabled = true;
        }

        function sendOtp() {
            const emailInput = document.getElementById('new_email');
            const btnSend = document.getElementById('btn-send-otp');
            const msg = document.getElementById('otp-message');
            
            if(!emailInput.value) return;

            btnSend.disabled = true;
            btnSend.innerText = 'Mengirim...';

            fetch('{{ route("profile.otp.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: emailInput.value })
            })
            .then(res => res.json())
            .then(data => {
                btnSend.disabled = false;
                btnSend.innerText = 'Kirim OTP';
                if(data.success) {
                    msg.style.display = 'block';
                    msg.innerText = data.message;
                    document.getElementById('formVerifyOtp').style.display = 'block';
                }
            })
            .catch(err => {
                btnSend.disabled = false;
                btnSend.innerText = 'Kirim OTP';
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }
    </script>
</body>
</html>
