@extends('layouts.app')

@section('title', 'Peringatan')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary mb-0">
            <i class="bi bi-bell me-2"></i>Pengingat Pembayaran
        </h1>
    </div>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                popup: 'rounded-3'
            }
        });
    </script>
    @endif

    <div class="row g-4 mb-5">
        <!-- Kartu Saldo -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-circle 
                            @if ($saldo <= 500000)
                                bg-light-red
                            @elseif ($saldo <= 1000000)
                                bg-light-yellow
                            @else
                                bg-light-green
                            @endif
                        ">
                            <i class="bi bi-wallet2 
                                @if ($saldo <= 500000)
                                    text-danger
                                @elseif ($saldo <= 1000000)
                                    text-warning
                                @else
                                    text-success
                                @endif
                            "></i>
                        </div>
                        <h5 class="card-title ms-3 mb-0">Saldo Saat Ini</h5>
                    </div>
                    <h3 class="fw-bold 
                        @if ($saldo <= 500000)
                            text-danger
                        @elseif ($saldo <= 1000000)
                            text-warning
                        @else
                            text-success
                        @endif
                    ">Rp{{ number_format($saldo, 0, ',', '.') }}</h3>
                    
                    @if ($saldo <= 500000)
                        <div class="alert alert-danger mt-3 mb-0 py-2">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>Saldo Anda sangat rendah!
                        </div>
                    @elseif ($saldo <= 1000000)
                        <div class="alert alert-warning mt-3 mb-0 py-2">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>Saldo Anda mendekati batas minimum!
                        </div>
                    @else
                        <div class="alert alert-success mt-3 mb-0 py-2">
                            <i class="bi bi-check-circle-fill me-2"></i>Keuangan Anda dalam kondisi baik!
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Kartu Tambah Pengingat -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Pengingat Baru
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('reminders.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label for="title" class="form-label fw-semibold">Judul Pengingat</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Tagihan Listrik" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="reminder_date" class="form-label fw-semibold">Tanggal Pengingat</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-calendar-date"></i>
                                    </span>
                                    <input type="date" class="form-control" id="reminder_date" name="reminder_date" required>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Pengingat -->
    <div class="card mb-5 border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-list-check me-2"></i>Daftar Pengingat
            </h5>
            <span class="badge bg-primary rounded-pill">{{ $reminders->count() }} Pengingat</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="35%">Judul Pengingat</th>
                            <th width="20%">Tanggal</th>
                            <th width="15%">Status</th>
                            <th width="25%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reminders as $index => $reminder)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-medium">{{ $reminder->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($reminder->reminder_date)->format('d-m-Y') }}</td>
                            <td>
                                @if(!$reminder->is_paid)
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                    <i class="bi bi-exclamation-circle me-1"></i>Belum Dibayar
                                </span>
                                @else
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i>Dibayar
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if(!$reminder->is_paid)
                                    <form action="{{ route('reminders.markAsPaid', $reminder->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Tandai Dibayar">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('reminders.markAsUnpaid', $reminder->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning" title="Tandai Belum Dibayar">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('reminders.cancel', $reminder->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pengingat ini?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                Belum ada pengingat yang ditambahkan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Batas Keuangan -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-sliders me-2"></i>Atur Batas Keuangan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('balanceAlerts.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="threshold_amount" class="form-label fw-semibold">Batas Keuangan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" class="form-control" id="threshold_amount" name="threshold_amount" placeholder="Minimum: 500.000" required min="500000">
                            </div>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>Minimum Rp 500.000
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-1"></i> Simpan Batas
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-bar-chart-line me-2"></i>Daftar Batas Keuangan
                    </h5>
                    <span class="badge bg-primary rounded-pill">{{ $balanceAlerts->count() }} Batas</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="30%">Batas Keuangan</th>
                                    <th width="40%">Status Peringatan</th>
                                    <th width="20%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($balanceAlerts as $index => $alert)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold">Rp {{ number_format($alert->threshold_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($alert->threshold_amount <= 500000)
                                            <div class="d-flex align-items-center">
                                                <span class="status-indicator bg-danger me-2"></span>
                                                <span>Jangan Banyak Pengeluaran</span>
                                            </div>
                                        @elseif ($alert->threshold_amount <= 1000000)
                                            <div class="d-flex align-items-center">
                                                <span class="status-indicator bg-warning me-2"></span>
                                                <span>Belum Diperingatkan</span>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center">
                                                <span class="status-indicator bg-success me-2"></span>
                                                <span>Keuangan Aman</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('balanceAlerts.delete', $alert->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus batas keuangan ini?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="bi bi-cash-stack display-6 d-block mb-2"></i>
                                        Belum ada batas keuangan yang ditetapkan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .icon-circle i {
        font-size: 1.5rem;
    }
    
    .bg-light-red {
        background-color: rgba(239, 68, 68, 0.1);
    }
    
    .bg-light-yellow {
        background-color: rgba(245, 158, 11, 0.1);
    }
    
    .bg-light-green {
        background-color: rgba(16, 185, 129, 0.1);
    }
    
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .table th {
        background-color: #f8fafc;
        font-weight: 600;
        padding: 1rem;
    }
    
    .table td {
        padding: 1rem;
        vertical-align: middle;
    }
    
    .status-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
    }
    
    .alert {
        border-radius: 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endsection