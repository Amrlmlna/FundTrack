<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FundTracker - Kelola Keuangan Anda dengan Cerdas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* General Styles */
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
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-5px);
            box-shadow: var(--box-shadow);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-5px);
            box-shadow: var(--box-shadow);
        }

        .section {
            padding: 100px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--dark);
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--secondary);
            text-align: center;
            max-width: 700px;
            margin: 0 auto 3rem;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .navbar-logo i {
            font-size: 1.75rem;
            margin-right: 0.5rem;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            align-items: center;
        }

        .navbar-item {
            margin-left: 2rem;
        }

        .navbar-link {
            font-weight: 500;
            color: var(--dark);
            position: relative;
            padding: 0.5rem 0;
        }

        .navbar-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: var(--transition);
        }

        .navbar-link:hover {
            color: var(--primary);
        }

        .navbar-link:hover::after {
            width: 100%;
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 1rem;
            margin-left: 2rem;
        }

        .btn-auth {
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-login:hover {
            background-color: rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }

        .btn-register {
            background-color: var(--primary);
            color: white;
            border: none;
        }

        .btn-register:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .mobile-menu-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
            overflow: hidden;
        }

        .hero-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hero-content {
            max-width: 600px;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }

        .hero-title span {
            color: var(--primary);
            position: relative;
            display: inline-block;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background-color: rgba(59, 130, 246, 0.2);
            z-index: -1;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--secondary);
            margin-bottom: 2rem;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
        }

        .hero-image {
            position: relative;
            width: 50%;
        }

        .hero-image img {
            width: 100%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        .hero-shape {
            position: absolute;
            z-index: 0;
        }

        .hero-shape-1 {
            top: 20%;
            left: 5%;
            width: 60px;
            height: 60px;
            background-color: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            animation: pulse 4s infinite;
        }

        .hero-shape-2 {
            bottom: 15%;
            right: 10%;
            width: 80px;
            height: 80px;
            background-color: rgba(16, 185, 129, 0.1);
            border-radius: 50%;
            animation: pulse 6s infinite;
        }

        .hero-shape-3 {
            top: 40%;
            right: 20%;
            width: 40px;
            height: 40px;
            background-color: rgba(245, 158, 11, 0.1);
            border-radius: 50%;
            animation: pulse 5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.7;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Features Section */
        .features {
            background-color: white;
            position: relative;
        }

        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            text-align: center;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
            transition: var(--transition);
            z-index: -1;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--box-shadow);
        }

        .feature-card:hover::before {
            height: 100%;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            color: var(--primary);
            font-size: 2rem;
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon {
            background-color: var(--primary);
            color: white;
            transform: rotateY(360deg);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .feature-description {
            color: var(--secondary);
            line-height: 1.6;
        }

        /* About Section */
        .about {
            position: relative;
            overflow: hidden;
        }

        .about-container {
            display: flex;
            align-items: center;
            gap: 4rem;
        }

        .about-image {
            flex: 1;
            position: relative;
        }

        .about-image img {
            width: 100%;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .about-image::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            width: 100%;
            height: 100%;
            border: 2px dashed var(--primary);
            border-radius: var(--border-radius);
            z-index: -1;
        }

        .about-content {
            flex: 1;
        }

        .about-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }

        .about-description {
            color: var(--secondary);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .about-features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .about-feature {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .about-feature-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            color: var(--primary);
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .about-feature-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .about-feature-description {
            color: var(--secondary);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Contact Section */
        .contact {
            background-color: white;
            position: relative;
        }

        .contact-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 4rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .contact-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }

        .contact-description {
            color: var(--secondary);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .contact-item-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            color: var(--primary);
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .contact-item-content {
            flex: 1;
        }

        .contact-item-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .contact-item-description {
            color: var(--secondary);
            line-height: 1.6;
        }

        .contact-form {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--box-shadow);
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

        /* Footer */
        .footer {
            background-color: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
        }

        .footer-logo i {
            font-size: 1.75rem;
            margin-right: 0.5rem;
        }

        .footer-description {
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .footer-social-link {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            font-size: 1.25rem;
            transition: var(--transition);
        }

        .footer-social-link:hover {
            background-color: var(--primary);
            transform: translateY(-5px);
        }

        .footer-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
        }

        .footer-links {
            list-style: none;
        }

        .footer-link {
            margin-bottom: 1rem;
        }

        .footer-link a {
            color: var(--gray);
            transition: var(--transition);
        }

        .footer-link a:hover {
            color: white;
            padding-left: 0.5rem;
        }

        .footer-contact {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .footer-contact-icon {
            color: var(--primary);
            font-size: 1.25rem;
        }

        .footer-contact-text {
            color: var(--gray);
            line-height: 1.6;
        }

        .footer-bottom {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: var(--gray);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
            }

            .hero-content {
                margin-bottom: 3rem;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-image {
                width: 80%;
            }

            .about-container {
                flex-direction: column;
            }

            .contact-container {
                grid-template-columns: 1fr;
            }

            .contact-info {
                order: 2;
            }

            .contact-form {
                order: 1;
                margin-bottom: 3rem;
            }
        }

        @media (max-width: 768px) {
            .section {
                padding: 70px 0;
            }

            .section-title {
                font-size: 2rem;
            }

            .navbar-menu {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 80%;
                height: calc(100vh - 70px);
                background-color: white;
                flex-direction: column;
                align-items: center;
                padding: 2rem;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transition: var(--transition);
            }

            .navbar-menu.active {
                left: 0;
            }

            .navbar-item {
                margin: 1rem 0;
            }

            .auth-buttons {
                margin: 1rem 0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .about-features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container navbar-container">
            <a href="#" class="navbar-logo">
                <i class="bi bi-coin"></i>
                FundTracker
            </a>
            <ul class="navbar-menu">
                <li class="navbar-item">
                    <a href="#home" class="navbar-link">Home</a>
                </li>
                <li class="navbar-item">
                    <a href="#features" class="navbar-link">Features</a>
                </li>
                <li class="navbar-item">
                    <a href="#about" class="navbar-link">About</a>
                </li>
                <li class="navbar-item">
                    <a href="#contact" class="navbar-link">Contact</a>
                </li>
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn-auth btn-login">Login</a>
                    <a href="{{ route('register') }}" class="btn-auth btn-register">Register</a>
                </div>
            </ul>
            <div class="mobile-menu-toggle">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container hero-container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Kelola <span>Keuangan</span> Anda dengan Cerdas
                </h1>
                <p class="hero-subtitle">
                    Platform manajemen keuangan yang membantu Anda mengatur, menganalisis, dan merencanakan keuangan pribadi dengan mudah.
                </p>
                <div class="hero-buttons">
                    @auth
                        <a href="{{ route('reminders.index') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">Mulai Sekarang</a>
                        <a href="#features" class="btn btn-outline">Pelajari Lebih Lanjut</a>
                    @endauth
                </div>
            </div>
            <div class="hero-image">
            <img src="{{ asset('3dModel.gif') }}" alt="3D Animation" style="width: 700px; height: auto;" />
            </div>
        </div>
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>
        <div class="hero-shape hero-shape-3"></div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section features">
        <div class="container">
            <h2 class="section-title">Fitur Unggulan</h2>
            <p class="section-subtitle">
                Nikmati berbagai fitur canggih yang dirancang untuk membantu Anda mengelola keuangan dengan lebih efektif.
            </p>
            <div class="features-container">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <h3 class="feature-title">Pencatatan Keuangan</h3>
                    <p class="feature-description">
                        Catat pendapatan dan pengeluaran Anda dengan mudah dan terorganisir untuk melacak aliran keuangan.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h3 class="feature-title">Analisis Keuangan</h3>
                    <p class="feature-description">
                        Dapatkan wawasan mendalam tentang pola pengeluaran dan pendapatan Anda melalui grafik dan laporan.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-bell"></i>
                    </div>
                    <h3 class="feature-title">Pengingat Pembayaran</h3>
                    <p class="feature-description">
                        Atur pengingat untuk tagihan dan pembayaran penting agar Anda tidak pernah melewatkan tenggat waktu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about">
        <div class="container about-container">
            <div class="about-image">
            <img src="{{ asset('about.png') }}" alt="3D Animation" />
            </div>
            <div class="about-content">
                <h2 class="about-title">Tentang Platform Kami</h2>
                <p class="about-description">
                    FundTracker adalah platform manajemen keuangan pribadi yang dirancang untuk membantu Anda mencapai kebebasan finansial. Kami menyediakan alat dan wawasan yang Anda butuhkan untuk mengatur, menganalisis, dan merencanakan keuangan Anda dengan lebih efektif.
                </p>
                <div class="about-features">
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <h4 class="about-feature-title">Keamanan Terjamin</h4>
                            <p class="about-feature-description">
                                Data keuangan Anda selalu aman dan terenkripsi.
                            </p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <div>
                            <h4 class="about-feature-title">Mudah Digunakan</h4>
                            <p class="about-feature-description">
                                Antarmuka yang intuitif dan ramah pengguna.
                            </p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div>
                            <h4 class="about-feature-title">Laporan Terperinci</h4>
                            <p class="about-feature-description">
                                Analisis mendalam tentang keuangan Anda.
                            </p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <h4 class="about-feature-title">Akses 24/7</h4>
                            <p class="about-feature-description">
                                Akses kapan saja dan di mana saja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact">
        <div class="container">
            <h2 class="section-title">Hubungi Kami</h2>
            <p class="section-subtitle">
                Punya pertanyaan atau masukan? Jangan ragu untuk menghubungi kami.
            </p>
            <div class="contact-container">
                <div class="contact-info">
                    <h3 class="contact-title">Informasi Kontak</h3>
                    <p class="contact-description">
                        Kami siap membantu Anda dengan pertanyaan atau masukan apa pun. Hubungi kami melalui salah satu saluran di bawah ini.
                    </p>
                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="contact-item-content">
                            <h4 class="contact-item-title">Alamat</h4>
                            <p class="contact-item-description">
                                Jl. Keuangan No. 123, Jakarta Selatan, Indonesia
                            </p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="contact-item-content">
                            <h4 class="contact-item-title">Email</h4>
                            <p class="contact-item-description">
                                info@FundTracker.com
                            </p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="contact-item-content">
                            <h4 class="contact-item-title">Telepon</h4>
                            <p class="contact-item-description">
                                +62 21 1234 5678
                            </p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan alamat email Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Masukkan subjek pesan" required>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea id="message" name="message" class="form-control" rows="5" placeholder="Tulis pesan Anda di sini" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-container">
            <div>
                <a href="#" class="footer-logo">
                    <i class="bi bi-coin"></i>
                    FundTracker
                </a>
                <p class="footer-description">
                    Platform manajemen keuangan pribadi yang membantu Anda mencapai kebebasan finansial.
                </p>
                <div class="footer-social">
                    <a href="#" class="footer-social-link">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="footer-social-link">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="footer-social-link">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="footer-social-link">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="footer-title">Tautan Cepat</h4>
                <ul class="footer-links">
                    <li class="footer-link"><a href="#home">Home</a></li>
                    <li class="footer-link"><a href="#features">Fitur</a></li>
                    <li class="footer-link"><a href="#about">Tentang Kami</a></li>
                    <li class="footer-link"><a href="#contact">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Layanan</h4>
                <ul class="footer-links">
                    <li class="footer-link"><a href="#">Pencatatan Keuangan</a></li>
                    <li class="footer-link"><a href="#">Analisis Keuangan</a></li>
                    <li class="footer-link"><a href="#">Pengingat Pembayaran</a></li>
                    <li class="footer-link"><a href="#">Laporan Keuangan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Kontak Kami</h4>
                <div class="footer-contact">
                    <i class="bi bi-geo-alt footer-contact-icon"></i>
                    <p class="footer-contact-text">
                        Jl. Keuangan No. 123, Jakarta Selatan, Indonesia
                    </p>
                </div>
                <div class="footer-contact">
                    <i class="bi bi-envelope footer-contact-icon"></i>
                    <p class="footer-contact-text">
                        info@FundTracker.com
                    </p>
                </div>
                <div class="footer-contact">
                    <i class="bi bi-telephone footer-contact-icon"></i>
                    <p class="footer-contact-text">
                        +62 21 1234 5678
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 FundTracker. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const navbarMenu = document.querySelector('.navbar-menu');

        mobileMenuToggle.addEventListener('click', () => {
            navbarMenu.classList.toggle('active');
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (navbarMenu.classList.contains('active')) {
                    navbarMenu.classList.remove('active');
                }
            });
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem 0';
                navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            } else {
                navbar.style.padding = '1rem 0';
                navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            }
        });
    </script>
</body>

</html>
