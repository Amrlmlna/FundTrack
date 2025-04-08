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
</head>

<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        font-family: 'Poppins', sans-serif;
        color: #334155;
        min-height: 100vh;
        padding-bottom: 60px;
        margin: 0;
    }

    /* Navbar Styling */
    .navbar {
        background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 0.75rem 1rem;
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: white !important;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar-brand i {
        font-size: 1.75rem;
        animation: pulse 2s infinite;
    }

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

    .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        margin: 0 0.25rem;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white !important;
        transform: translateY(-2px);
    }

    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: white !important;
    }

    /* Notification Styling */
    .notification {
        position: relative;
    }

    .notification .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        padding: 0.25rem 0.5rem;
        border-radius: 50%;
        background-color: #ef4444;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .notification .dropdown-menu {
        width: 300px;
        padding: 0;
        overflow: hidden;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .notification .dropdown-header {
        background-color: #f8fafc;
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
        color: #64748b;
    }

    .notification .dropdown-item.no-notifications {
        text-align: center;
        color: #64748b;
        padding: 2rem 1rem;
    }

    /* Container Styling */
    .container {
        padding: 2rem 1rem;
    }

    /* Card Styling */
    .card {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
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
    }

    .btn-primary {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }

    .btn-primary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
        transform: translateY(-2px);
    }

    /* Table Styling */
    .table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th {
        background-color: #f8fafc;
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid #e2e8f0;
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
        background-color: #1e293b;
        color: white;
        text-align: center;
        padding: 1rem;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.25rem;
        }
        
        .navbar-brand i {
            font-size: 1.5rem;
        }
        
        .nav-link {
            padding: 0.5rem 0.75rem;
        }
        
        .notification .dropdown-menu {
            width: 280px;
        }
        
        .container {
            padding: 1rem 0.5rem;
        }
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home">
                <i class="bi bi-coin"></i>
                FundTracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pendapatan*') ? 'active' : '' }}" href="{{ route('pendapatan.index') }}">
                            <i class="bi bi-graph-up-arrow me-1"></i> Pendapatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}" href="{{ route('pengeluaran.index') }}">
                            <i class="bi bi-graph-down-arrow me-1"></i> Pengeluaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
                            <i class="bi bi-file-earmark-text me-1"></i> Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan/chart') ? 'active' : '' }}" href="{{ route('laporan.chart') }}">
                            <i class="bi bi-pie-chart me-1"></i> Grafik
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('reminders*') ? 'active' : '' }}" href="{{ route('reminders.index') }}">
                            <i class="bi bi-bell me-1"></i> Peringatan
                        </a>
                    </li>
                </ul>
                <div class="notification">
                    <a href="#" class="nav-link position-relative" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell-fill fs-5"></i>
                        @if($unpaidReminders->count() > 0)
                            <span class="badge">{{ $unpaidReminders->count() }}</span>
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
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p class="mb-0">&copy; {{ date('Y') }} Smart Finance. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>