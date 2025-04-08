<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Smart Finance</title>
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

        .forgot-password-container {
            width: 100%;
            max-width: 450px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .forgot-password-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 2.5rem;
            text-align: center;
            color: white;
        }

        .forgot-password-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .forgot-password-logo i {
            font-size: 2.5rem;
            margin-right: 0.75rem;
        }

        .forgot-password-logo-text {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .forgot-password-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .forgot-password-subtitle {
            font-size: 1rem;
            opacity: 0.9;
        }

        .forgot-password-form {
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

        .forgot-password-footer {
            text-align: center;
            padding: 0 2.5rem 2.5rem;
        }

        .forgot-password-footer-text {
            font-size: 0.875rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        .forgot-password-footer-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-password-footer-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--danger);
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <div class="forgot-password-header">
            <div class="forgot-password-logo">
                <i class="bi bi-coin"></i>
                <span class="forgot-password-logo-text">Smart Finance</span>
            </div>
            <h1 class="forgot-password-title">Lupa Password?</h1>
            <p class="forgot-password-subtitle">Masukkan email Anda untuk mereset password</p>
        </div>
        
        @if (session('status'))
            <div class="alert alert-success" style="margin: 1rem 2.5rem 0;">
                {{ session('status') }}
            </div>
        @endif
        
        <form class="forgot-password-form" action="{{ route('password.email') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Kirim Link Reset Password</button>
        </form>
        
        <div class="forgot-password-footer">
            <p class="forgot-password-footer-text">
                <a href="{{ route('login') }}" class="forgot-password-footer-link">
                    <i class="bi bi-arrow-left"></i> Kembali ke Halaman Login
                </a>
            </p>
        </div>
    </div>
</body>
</html>