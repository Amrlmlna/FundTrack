<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Finance</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --light: #f8fafc;
            --dark: #1e293b;
            --gray: #94a3b8;
            --border-radius: 0.75rem;
            --box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 2.5rem;
            text-align: center;
            color: white;
        }

        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .login-logo i {
            font-size: 2.5rem;
            margin-right: 0.75rem;
        }

        .login-logo-text {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            font-size: 1rem;
            opacity: 0.9;
        }

        .login-form {
            padding: 2.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .form-error {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check-input {
            margin-right: 0.5rem;
            width: 1rem;
            height: 1rem;
        }

        .form-check-label {
            font-size: 0.875rem;
            color: var(--secondary);
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            font-size: 1rem;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .login-footer {
            text-align: center;
            padding: 0 2.5rem 2.5rem;
        }

        .login-footer-text {
            font-size: 0.875rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        .login-footer-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .login-footer-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .login-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .login-divider-line {
            flex: 1;
            height: 1px;
            background-color: #e2e8f0;
        }

        .login-divider-text {
            padding: 0 1rem;
            color: var(--secondary);
            font-size: 0.875rem;
        }

        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
            border-radius: 0.5rem;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            color: var(--dark);
            transition: var(--transition);
        }

        .social-btn:hover {
            background-color: #f1f5f9;
            transform: translateY(-2px);
        }

        .social-btn i {
            font-size: 1.25rem;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 1.5rem;
        }

        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: var(--transition);
        }

        .forgot-password a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--danger);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <i class="bi bi-coin"></i>
                <span class="login-logo-text">Smart Finance</span>
            </div>
            <h1 class="login-title">Selamat Datang Kembali</h1>
            <p class="login-subtitle">Masuk untuk melanjutkan ke akun Anda</p>
        </div>
        
        @if (session('status'))
            <div class="alert alert-success" style="margin: 1rem 2.5rem 0;">
                {{ session('status') }}
            </div>
        @endif
        
        <form class="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password Anda" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>
            
            <div class="form-check">
                <input type="checkbox" id="remember" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="form-check-label">Ingat saya</label>
            </div>
            
            <button type="submit" class="btn btn-primary">Masuk</button>
            
            <div class="login-divider">
                <div class="login-divider-line"></div>
                <span class="login-divider-text">atau</span>
                <div class="login-divider-line"></div>
            </div>
            
            <div class="social-login">
                <a href="#" class="social-btn">
                    <i class="bi bi-google"></i>
                </a>
                <a href="#" class="social-btn">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="social-btn">
                    <i class="bi bi-twitter"></i>
                </a>
            </div>
        </form>
        
        <div class="login-footer">
            <p class="login-footer-text">Belum punya akun? <a href="{{ route('register') }}" class="login-footer-link">Daftar sekarang</a></p>
            <p class="login-footer-text">
                <a href="/" class="login-footer-link">
                    <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                </a>
            </p>
        </div>
    </div>
</body>
</html>