@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary mb-0">
            <i class="bi bi-file-earmark-text me-2"></i>Laporan Keuangan
        </h1>
    </div>

    <div class="card mb-5">
        <div class="card-header d-flex align-items-center">
            <i class="bi bi-calendar-range me-2"></i>
            <span>Pilih Rentang Waktu</span>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('laporan.generate') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="start_date" class="form-label fw-semibold">Tanggal Mulai</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-calendar-date"></i>
                            </span>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="end_date" class="form-label fw-semibold">Tanggal Selesai</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-calendar-date"></i>
                            </span>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Generate
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(isset($pendapatan) && isset($pengeluaran))
    <div class="report-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fs-4 fw-bold text-dark">
                <i class="bi bi-calendar-check me-2"></i>Laporan: {{ \Carbon\Carbon::parse(request()->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse(request()->end_date)->format('d M Y') }}
            </h2>
            <button class="btn btn-success" id="printBtn">
                <i class="bi bi-printer me-1"></i> Cetak Laporan
            </button>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-light-blue">
                                <i class="bi bi-wallet2 text-primary"></i>
                            </div>
                            <h5 class="card-title ms-3 mb-0">Saldo Bulan Lalu</h5>
                        </div>
                        <h3 class="fw-bold text-primary">Rp{{ number_format($saldoBulanLalu, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-light-green">
                                <i class="bi bi-graph-up-arrow text-success"></i>
                            </div>
                            <h5 class="card-title ms-3 mb-0">Pendapatan</h5>
                        </div>
                        <h3 class="fw-bold text-success">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-light-red">
                                <i class="bi bi-graph-down-arrow text-danger"></i>
                            </div>
                            <h5 class="card-title ms-3 mb-0">Pengeluaran</h5>
                        </div>
                        <h3 class="fw-bold text-danger">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-light-purple">
                                <i class="bi bi-cash-coin text-purple"></i>
                            </div>
                            <h5 class="card-title ms-3 mb-0">Saldo Sekarang</h5>
                        </div>
                        <h3 class="fw-bold text-purple">Rp{{ number_format($saldoSekarang, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-5">
            <div class="card-header bg-success-subtle">
                <h3 class="card-title mb-0 text-success fw-bold">
                    <i class="bi bi-graph-up me-2"></i>Pendapatan
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendapatan as $item)
                            <tr>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                        {{ $item->kategori->nama_kategori }}
                                    </span>
                                </td>
                                <td class="fw-semibold">Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $item->deskripsi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <h4 class="text-end mb-0">Total Pendapatan: <span class="fw-bold text-success">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</span></h4>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header bg-danger-subtle">
                <h3 class="card-title mb-0 text-danger fw-bold">
                    <i class="bi bi-graph-down me-2"></i>Pengeluaran
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengeluaran as $item)
                            <tr>
                                <td>
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                        {{ $item->kategori->nama_kategori }}
                                    </span>
                                </td>
                                <td class="fw-semibold">Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $item->deskripsi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <h4 class="text-end mb-0">Total Pengeluaran: <span class="fw-bold text-danger">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</span></h4>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="text-end mb-0">Saldo Akhir: <span class="fw-bold text-primary fs-3">Rp{{ number_format($totalPendapatan - $totalPengeluaran, 0, ',', '.') }}</span></h4>
            </div>
        </div>
    </div>
    @endif
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
    
    .bg-light-blue {
        background-color: rgba(59, 130, 246, 0.1);
    }
    
    .bg-light-green {
        background-color: rgba(16, 185, 129, 0.1);
    }
    
    .bg-light-red {
        background-color: rgba(239, 68, 68, 0.1);
    }
    
    .bg-light-purple {
        background-color: rgba(139, 92, 246, 0.1);
    }
    
    .text-purple {
        color: #8b5cf6;
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
    
    @media print {
        body * {
            visibility: hidden;
        }
        
        .report-container, .report-container * {
            visibility: visible;
        }
        
        .report-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        
        .btn {
            display: none;
        }
    }
</style>

<script>
    document.getElementById('printBtn').addEventListener('click', function() {
        window.print();
    });
</script>
@endsection