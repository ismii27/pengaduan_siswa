<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        :root {
            --main-blue: #2196f3;
            --main-blue-light: #e3f2fd;
            --main-blue-dark: #1565c0;
            --main-white: #fff;
            --main-shadow: rgba(33, 150, 243, 0.13);
        }
        * {
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, var(--main-blue-light) 0%, var(--main-blue) 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: var(--main-white);
            padding: 2.5rem 2rem 2rem 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 var(--main-shadow);
            width: 100%;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-title {
            color: var(--main-blue-dark);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .login-subtitle {
            color: #607d8b;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 0.5px;
        }
        .form-group {
            margin-bottom: 1.2rem;
            width: 100%;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--main-blue-dark);
            font-size: 1.05rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid var(--main-blue-light);
            border-radius: 0.7rem;
            background: var(--main-blue-light);
            font-size: 1.08rem;
            color: var(--main-blue-dark);
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px 0 var(--main-shadow);
            box-sizing: border-box;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border: 1.5px solid var(--main-blue-dark);
            box-shadow: 0 4px 16px 0 var(--main-shadow);
        }
        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(90deg, var(--main-blue) 0%, var(--main-blue-dark) 100%);
            color: var(--main-white);
            border: none;
            border-radius: 0.7rem;
            font-size: 1.15rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px 0 var(--main-shadow);
            margin-top: 0.5rem;
            box-sizing: border-box;
        }
        .btn-login:hover {
            background: linear-gradient(90deg, var(--main-blue-dark) 0%, var(--main-blue) 100%);
            box-shadow: 0 4px 16px 0 var(--main-shadow);
        }
        .error {
            color: var(--main-white);
            background: var(--main-blue-dark);
            border: 1.5px solid var(--main-blue);
            border-radius: 0.7rem;
            padding: 0.7rem 1rem;
            margin-bottom: 1.2rem;
            text-align: center;
            font-size: 1.05rem;
            font-weight: 500;
            box-shadow: 0 2px 8px 0 var(--main-shadow);
            animation: popup 0.3s cubic-bezier(.68,-0.55,.27,1.55);
        }
        @keyframes popup {
            0% { transform: scale(0.8); opacity: 0; }
            80% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
        .emoji {
            font-size: 1.5rem;
            margin-right: 0.2rem;
        }
        @media (max-width: 400px) {
            .login-container {
                padding: 1.5rem 0.5rem;
                max-width: 98vw;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-title"><span class="emoji">🔐</span>Login</div>
        <div class="login-subtitle">Selamat datang kembali!<br>Silakan masuk ke akun Anda <span class="emoji">👋</span></div>
        @if(session('error'))
            <div class="error">{{ session('error') }} <span class="emoji">⚠️</span></div>
        @endif
        <form method="POST" action="{{ route('login') }}" style="width:100%">
            @csrf
            <div class="form-group">
                <label for="username">Username <span class="emoji">👤</span></label>
                <input type="text" id="username" name="username" required autofocus autocomplete="username">
            </div>
            <div class="form-group">
                <label for="password">Password <span class="emoji">🔑</span></label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn-login">Masuk <span class="emoji">➡️</span></button>
        </form>
    </div>
</body>
</html>
