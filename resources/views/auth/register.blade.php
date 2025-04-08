<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Smart Finance</title>
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

        .register-container {
            width: 100%;
            max-width: 500px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 2.5rem;
            text-align: center;
            color: white;
        }

        .register-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .register-logo i {
            font-size: 2.5rem;
            margin-right: 0.75rem;
        }

        .register-logo-text {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .register-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .register-subtitle {
            font-size: 1rem;
            opacity: 0.9;
        }

        .register-form {
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

        .register-footer {
            text-align: center;
            padding: 0 2.5rem 2.5rem;
        }

        .register-footer-text {
            font-size: 0.875rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        .register-footer-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .register-footer-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .register-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .register-divider-line {
            flex: 1;
            height: 1px;
            background-color: #e2e8f0;
        }

        .register-divider-text {
            padding: 0 1rem;
            color: var(--secondary);
            font-size: 0.875rem;
        }

        .social-register {
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

        .password-requirements {
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: var(--secondary);
        }

        .password-requirements ul {
            list-style-type: none;
            padding-left: 0.5rem;
            margin-top: 0.25rem;
        }

        .password-requirements li {
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
        }

        .password-requirements li::before {
            content: "•";
            color: var(--primary);
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="register-logo">
                <i class="bi bi-coin"></i>
                <span class="register-logo-text">Smart Finance</span>
            </div>
            <h1 class="register-title">Buat Akun Baru</h1>
            <p class="register-subtitle">Mulai perjalanan keuangan Anda bersama kami</p>
        </div>
        
        <form class="register-form" action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Buat password Anda" required>
                <div class="password-requirements">
                    Password harus memenuhi kriteria berikut:
                    <ul>
                        <li>Minimal 8 karakter</li>
                        <li>Kombinasi huruf dan angka</li>
                    </ul>
                </div>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi password Anda" required>
            </div>
            
            <div class="form-check">
                <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
                <label for="terms" class="form-check-label">Saya menyetujui <a href="#" class="register-footer-link">Syarat dan Ketentuan</a> serta <a href="#" class="register-footer-link">Kebijakan Privasi</a></label>
            </div>
            
            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
            
            <div class="register-divider">
                <div class="register-divider-line"></div>
                <span class="register-divider-text">atau daftar dengan</span>
                <div class="register-divider-line"></div>
            </div>
            
            <div class="social-register">
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
        
        <div class="register-footer">
            <p class="register-footer-text">Sudah punya akun? <a href="{{ route('login') }}" class="register-footer-link">Masuk sekarang</a></p>
            <p class="register-footer-text">
                <a href="/" class="register-footer-link">
                    <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                </a>
            </p>
        </div>
    </div>
</body>
</html>