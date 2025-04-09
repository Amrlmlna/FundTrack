<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') FundTracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #2563eb;
        --secondary: #64748b;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
        --info: #0ea5e9;
        --light: #f8fafc;
        --dark: #1e293b;
        --sidebar-width: 260px;
        --sidebar-collapsed-width: 70px;
        --navbar-height: 60px;
        --footer-height: 50px;
    }

    body {
        background: #f5f7fa;
        font-family: 'Poppins', sans-serif;
        color: #334155;
        min-height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
    }

    /* Navbar Styling */
    .navbar {
        height: var(--navbar-height);
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 0 1.5rem;
        position: fixed;
        top: 0;
        right: 0;
        left: var(--sidebar-width);
        z-index: 990;
        transition: all 0.3s ease;
    }

    .navbar-collapsed {
        left: var(--sidebar-collapsed-width);
    }

    .navbar-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        width: 100%;
    }

    .navbar-left {
        display: flex;
        align-items: center;
    }

    .mobile-toggle {
        display: none;
        background: transparent;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--primary);
        margin-right: 1rem;
    }

    .page-title {
        font-weight: 600;
        font-size: 1.25rem;
        color: #334155;
        margin: 0;
    }

    .navbar-right {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-left: auto; /* This ensures it stays at the far right */
    }

    /* Notification Styling */
    .notification {
        position: relative;
    }

    .notification-icon {
        font-size: 1.25rem;
        color: var(--secondary);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .notification-icon:hover {
        color: var(--primary);
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background-color: var(--danger);
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .notification .dropdown-menu {
        width: 320px;
        padding: 0;
        overflow: hidden;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: none;
        margin-top: 0.75rem;
    }

    .notification .dropdown-header {
        background-color: var(--light);
        padding: 1rem;
        font-weight: 600;
        border-bottom: 1px solid #e2e8f0;
    }

    .notification .dropdown-item {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }

    .notification .dropdown-item:hover {
        background-color: #f1f5f9;
    }

    .notification .dropdown-item .notification-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .notification .dropdown-item .notification-time {
        font-size: 0.75rem;
        color: var(--secondary);
    }

    .notification .dropdown-item.no-notifications {
        text-align: center;
        color: var(--secondary);
        padding: 2rem 1rem;
    }

    /* User Dropdown */
    .user-dropdown {
        position: relative;
    }

    .user-dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .user-dropdown-toggle:hover {
        background-color: #f1f5f9;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1rem;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.875rem;
        color: #334155;
    }

    .user-role {
        font-size: 0.75rem;
        color: var(--secondary);
    }

    .user-dropdown .dropdown-menu {
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 0.5rem;
        min-width: 200px;
        margin-top: 0.75rem;
    }

    .user-dropdown .dropdown-item {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-dropdown .dropdown-item:hover {
        background-color: #f1f5f9;
    }

    .user-dropdown .dropdown-item i {
        font-size: 1rem;
        color: var(--secondary);
    }

    .user-dropdown .dropdown-divider {
        margin: 0.5rem 0;
        background-color: #e2e8f0;
    }

    .user-dropdown .dropdown-item.logout {
        color: var(--danger);
    }

    .user-dropdown .dropdown-item.logout i {
        color: var(--danger);
    }

    /* Sidebar Styling */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: var(--sidebar-width);
        background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
        box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: all 0.3s ease;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .sidebar-collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar-header {
        padding: 1.5rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
    }

    .sidebar-brand i {
        font-size: 1.75rem;
    }

    .sidebar-toggle {
        background: transparent;
        border: none;
        color: white;
        font-size: 1.25rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .sidebar-toggle:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar-menu {
        padding: 1rem 0;
    }

    .sidebar-item {
        padding: 0.25rem 1rem;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        font-weight: 500;
        position: relative;
    }

    .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .sidebar-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .sidebar-link i {
        font-size: 1.25rem;
        min-width: 24px;
        text-align: center;
    }

    .sidebar-link span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar-divider {
        height: 1px;
        background-color: rgba(255, 255, 255, 0.1);
        margin: 0.75rem 1rem;
    }

    /* Main Content */
    .main-content {
        margin-left: var(--sidebar-width);
        margin-top: var(--navbar-height);
        padding-bottom: var(--footer-height);
        flex: 1;
        transition: all 0.3s ease;
        min-height: calc(100vh - var(--navbar-height) - var(--footer-height));
    }

    .main-content-collapsed {
        margin-left: var(--sidebar-collapsed-width);
    }

    /* Container Styling */
    .container-fluid {
        padding: 1.5rem;
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Card Styling */
    .card {
        border-radius: 0.75rem;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        background-color: white;
    }

    .card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: white;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.1rem;
        color: #334155;
    }

    .card-header-title i {
        color: var(--primary);
    }

    .card-header-actions {
        display: flex;
        gap: 0.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Button Styling */
    .btn {
        border-radius: 0.5rem;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn i {
        font-size: 1rem;
    }

    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    /* Table Styling */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .table th {
        background-color: #f8fafc;
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid #e2e8f0;
        color: #64748b;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tr:hover {
        background-color: #f8fafc;
    }

    /* Footer Styling */
    footer {
        background-color: white;
        color: #64748b;
        text-align: center;
        padding: 1rem;
        position: fixed;
        bottom: 0;
        width: 100%;
        height: var(--footer-height);
        border-top: 1px solid #f1f5f9;
        z-index: 900;
        margin-left: var(--sidebar-width);
        transition: all 0.3s ease;
    }

    footer.footer-collapsed {
        margin-left: var(--sidebar-collapsed-width);
    }

    /* Form Controls */
    .form-control, .form-select {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }

    .input-group-text {
        border-radius: 0.5rem;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    /* Badges */
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 600;
        border-radius: 0.375rem;
    }

    .badge-primary {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--primary);
    }

    .badge-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .badge-warning {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .badge-danger {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }
        
        .sidebar-open {
            transform: translateX(0);
        }
        
        .navbar {
            left: 0 !important;
        }
        
        .main-content {
            margin-left: 0 !important;
        }
        
        footer {
            margin-left: 0 !important;
        }
        
        .mobile-toggle {
            display: block;
        }
        
        .user-info {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .container-fluid {
            padding: 1rem;
        }
        
        .notification .dropdown-menu {
            width: 280px;
        }
        
        .page-title {
            font-size: 1.1rem;
        }
        
        .card-header {
            padding: 1rem;
        }
        
        .card-body {
            padding: 1rem;
        }
    }

    @media (max-width: 576px) {
        .navbar-right {
            gap: 1rem;
        }
    }

    /* Animations */
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    .pulse {
        animation: pulse 2s infinite;
    }
</style>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-brand">
                <i class="bi bi-coin pulse"></i>
                <span class="brand-text">FundTracker</span>
            </a>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="bi bi-chevron-left"></i>
            </button>
        </div>
        
        <div class="sidebar-menu">
            @auth
            <div class="sidebar-item">
                <a href="{{ route('pendapatan.index') }}" class="sidebar-link {{ request()->is('pendapatan*') ? 'active' : '' }}">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Pendapatan</span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="{{ route('pengeluaran.index') }}" class="sidebar-link {{ request()->is('pengeluaran*') ? 'active' : '' }}">
                    <i class="bi bi-graph-down-arrow"></i>
                    <span>Pengeluaran</span>
                </a>
            </div>
            
            <div class="sidebar-divider"></div>
            
            <div class="sidebar-item">
                <a href="{{ route('laporan.index') }}" class="sidebar-link {{ request()->is('laporan') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Laporan</span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="{{ route('laporan.chart') }}" class="sidebar-link {{ request()->is('laporan/chart') ? 'active' : '' }}">
                    <i class="bi bi-pie-chart"></i>
                    <span>Grafik</span>
                </a>
            </div>
            
            <div class="sidebar-divider"></div>
            
            <div class="sidebar-item">
                <a href="{{ route('reminders.index') }}" class="sidebar-link {{ request()->is('reminders*') ? 'active' : '' }}">
                    <i class="bi bi-bell"></i>
                    <span>Peringatan</span>
                </a>
            </div>
            @else
            <div class="sidebar-item">
                <a href="{{ route('login') }}" class="sidebar-link">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Masuk</span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="{{ route('register') }}" class="sidebar-link">
                    <i class="bi bi-person-plus"></i>
                    <span>Daftar</span>
                </a>
            </div>
            @endauth
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <div class="navbar-left">
                <button class="mobile-toggle" id="mobileToggle">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="page-title">@yield('title')</h1>
            </div>
            
            <div class="navbar-right">
                @auth
                <div class="notification dropdown">
                    <a href="#" class="notification-icon position-relative" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        @if($unpaidReminders->count() > 0)
                            <span class="notification-badge">{{ $unpaidReminders->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <div class="dropdown-header">Notifikasi</div>
                        @if($unpaidReminders->count() > 0)
                            @foreach ($unpaidReminders as $reminder)
                                <a class="dropdown-item" href="{{ route('reminders.index') }}">
                                    <div class="notification-title">
                                        <i class="bi bi-bell-fill text-warning"></i>
                                        {{ $reminder->title }}
                                    </div>
                                    <div class="notification-time">
                                        {{ \Carbon\Carbon::parse($reminder->reminder_date)->format('d M, Y') }}
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="dropdown-item no-notifications">
                                <i class="bi bi-check2-circle fs-4 d-block mb-2"></i>
                                Tidak ada pengingat baru
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="user-dropdown dropdown">
                    <a href="#" class="user-dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">User</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item logout">
                                    <i class="bi bi-box-arrow-right"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <footer id="footer">
        <p class="mb-0">&copy; {{ date('Y') }} Smart Finance. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const navbar = document.getElementById('navbar');
            const mainContent = document.getElementById('mainContent');
            const footer = document.getElementById('footer');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileToggle = document.getElementById('mobileToggle');
            const brandText = document.querySelector('.brand-text');
            
            // Function to toggle sidebar on desktop
            function toggleSidebar() {
                sidebar.classList.toggle('sidebar-collapsed');
                navbar.classList.toggle('navbar-collapsed');
                mainContent.classList.toggle('main-content-collapsed');
                footer.classList.toggle('footer-collapsed');
                
                // Toggle visibility of text elements in sidebar
                const textElements = sidebar.querySelectorAll('.sidebar-link span');
                textElements.forEach(el => {
                    el.style.display = el.style.display === 'none' ? '' : 'none';
                });
                
                // Toggle brand text
                brandText.style.display = brandText.style.display === 'none' ? '' : 'none';
                
                // Change toggle icon
                const toggleIcon = sidebarToggle.querySelector('i');
                toggleIcon.classList.toggle('bi-chevron-left');
                toggleIcon.classList.toggle('bi-chevron-right');
            }
            
            // Function to toggle sidebar on mobile
            function toggleMobileSidebar() {
                sidebar.classList.toggle('sidebar-open');
            }
            
            // Event listeners
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }
            
            if (mobileToggle) {
                mobileToggle.addEventListener('click', toggleMobileSidebar);
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isMobile = window.innerWidth < 992;
                if (isMobile && !sidebar.contains(event.target) && !mobileToggle.contains(event.target) && sidebar.classList.contains('sidebar-open')) {
                    sidebar.classList.remove('sidebar-open');
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('sidebar-open');
                }
            });
            
            // Set active page title
            const pageTitle = document.querySelector('.page-title');
            if (pageTitle) {
                const activeLink = document.querySelector('.sidebar-link.active');
                if (activeLink) {
                    const activeText = activeLink.querySelector('span').textContent;
                    pageTitle.textContent = activeText;
                }
            }
        });
    </script>
</body>

</html>
