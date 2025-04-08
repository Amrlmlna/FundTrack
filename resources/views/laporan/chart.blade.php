@extends('layouts.app')

@section('title', 'Grafik Keuangan')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-5 fw-bold text-primary mb-0 d-flex align-items-center">
                <i class="bi bi-pie-chart-fill me-3"></i>Grafik Keuangan
            </h1>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 mb-5 hover-lift">
        <div class="card-header bg-light border-0 py-3">
            <div class="d-flex align-items-center">
                <i class="bi bi-calendar-range fs-5 text-primary me-2"></i>
                <span class="fw-semibold">Pilih Rentang Waktu</span>
            </div>
        </div>
        <div class="card-body p-4">
            <form id="filterForm" method="GET" action="{{ route('laporan.chart') }}">
                <div class="row g-4">
                    <div class="col-md-5">
                        <label for="start_date" class="form-label fw-semibold text-secondary small text-uppercase">Tanggal Mulai</label>
                        <div class="input-group input-group-merge shadow-sm rounded-3 overflow-hidden">
                            <span class="input-group-text border-0 bg-light text-primary">
                                <i class="bi bi-calendar-date"></i>
                            </span>
                            <input type="date" class="form-control border-0 py-2" id="start_date" name="start_date" value="{{ request('start_date') }}" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="end_date" class="form-label fw-semibold text-secondary small text-uppercase">Tanggal Akhir</label>
                        <div class="input-group input-group-merge shadow-sm rounded-3 overflow-hidden">
                            <span class="input-group-text border-0 bg-light text-primary">
                                <i class="bi bi-calendar-date"></i>
                            </span>
                            <input type="date" class="form-control border-0 py-2" id="end_date" name="end_date" value="{{ request('end_date') }}" required>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm">
                            <i class="bi bi-search me-2"></i> Tampilkan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow border-0 rounded-4 hover-lift">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0 fw-bold text-primary d-flex align-items-center">
                    <i class="bi bi-graph-up-arrow me-2"></i>Pendapatan vs Pengeluaran
                </h3>
                <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                    <button type="button" class="btn btn-sm btn-primary active px-3 py-2" id="lineChartBtn">
                        <i class="bi bi-graph-up me-1"></i> Line
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-primary px-3 py-2" id="barChartBtn">
                        <i class="bi bi-bar-chart me-1"></i> Bar
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="chart-container" style="position: relative; height:65vh; width:100%">
                <canvas id="chartPendapatanPengeluaran"></canvas>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-center gap-4">
                <div class="d-flex align-items-center">
                    <span class="legend-indicator bg-success shadow-sm"></span>
                    <span class="fw-medium">Pendapatan</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="legend-indicator bg-danger shadow-sm"></span>
                    <span class="fw-medium">Pengeluaran</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .chart-container {
        margin: 0 auto;
    }
    
    .card {
        border-radius: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .legend-indicator {
        display: inline-block;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        margin-right: 10px;
    }
    
    .bg-success {
        background: linear-gradient(45deg, rgba(56, 178, 172, 1), rgba(75, 192, 192, 1));
    }
    
    .bg-danger {
        background: linear-gradient(45deg, rgba(225, 83, 97, 1), rgba(255, 99, 132, 1));
    }
    
    .input-group-merge .input-group-text,
    .input-group-merge .form-control {
        box-shadow: none;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #4361ee, #4895ef);
        border: none;
    }
    
    .btn-outline-primary {
        border-color: #4895ef;
        color: #4361ee;
    }
    
    .btn-outline-primary:hover {
        background: linear-gradient(45deg, #4361ee, #4895ef);
        border-color: transparent;
    }
    
    .text-primary {
        color: #4361ee !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('chartPendapatanPengeluaran').getContext('2d');
        var chartType = 'line';
        
        // Create gradient for datasets
        var pendapatanGradient = ctx.createLinearGradient(0, 0, 0, 400);
        pendapatanGradient.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
        pendapatanGradient.addColorStop(1, 'rgba(75, 192, 192, 0.1)');
        
        var pengeluaranGradient = ctx.createLinearGradient(0, 0, 0, 400);
        pengeluaranGradient.addColorStop(0, 'rgba(255, 99, 132, 0.6)');
        pengeluaranGradient.addColorStop(1, 'rgba(255, 99, 132, 0.1)');
        
        var chartData = {
            labels: {!! json_encode($labels) !!},
            datasets: [
                {
                    label: 'Pendapatan',
                    backgroundColor: pendapatanGradient,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgba(75, 192, 192, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.3,
                    data: {!! json_encode($pendapatanData) !!}
                },
                {
                    label: 'Pengeluaran',
                    backgroundColor: pengeluaranGradient,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgba(255, 99, 132, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(255, 99, 132, 1)',
                    tension: 0.3,
                    data: {!! json_encode($pengeluaranData) !!}
                }
            ]
        };
        
        var chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(255, 255, 255, 0.9)',
                    titleColor: '#333',
                    bodyColor: '#666',
                    borderColor: '#ddd',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 8,
                    boxShadow: '0 4px 6px rgba(0,0,0,0.1)',
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        color: '#666'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [3, 3],
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        color: '#666',
                        callback: function(value, index, values) {
                            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
                        }
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            }
        };
        
        var myChart = new Chart(ctx, {
            type: chartType,
            data: chartData,
            options: chartOptions
        });
        
        // Toggle between line and bar chart
        document.getElementById('lineChartBtn').addEventListener('click', function() {
            myChart.destroy();
            chartType = 'line';
            // Update dataset properties for line chart
            chartData.datasets[0].tension = 0.3;
            chartData.datasets[1].tension = 0.3;
            chartData.datasets[0].backgroundColor = pendapatanGradient;
            chartData.datasets[1].backgroundColor = pengeluaranGradient;
            
            myChart = new Chart(ctx, {
                type: chartType,
                data: chartData,
                options: chartOptions
            });
            document.getElementById('lineChartBtn').classList.add('active');
            document.getElementById('lineChartBtn').classList.remove('btn-outline-primary');
            document.getElementById('lineChartBtn').classList.add('btn-primary');
            document.getElementById('barChartBtn').classList.remove('active');
            document.getElementById('barChartBtn').classList.add('btn-outline-primary');
            document.getElementById('barChartBtn').classList.remove('btn-primary');
        });
        
        document.getElementById('barChartBtn').addEventListener('click', function() {
            myChart.destroy();
            chartType = 'bar';
            // Update dataset properties for bar chart
            chartData.datasets[0].tension = 0;
            chartData.datasets[1].tension = 0;
            chartData.datasets[0].backgroundColor = 'rgba(75, 192, 192, 0.7)';
            chartData.datasets[1].backgroundColor = 'rgba(255, 99, 132, 0.7)';
            
            myChart = new Chart(ctx, {
                type: chartType,
                data: chartData,
                options: chartOptions
            });
            document.getElementById('barChartBtn').classList.add('active');
            document.getElementById('barChartBtn').classList.remove('btn-outline-primary');
            document.getElementById('barChartBtn').classList.add('btn-primary');
            document.getElementById('lineChartBtn').classList.remove('active');
            document.getElementById('lineChartBtn').classList.add('btn-outline-primary');
            document.getElementById('lineChartBtn').classList.remove('btn-primary');
        });
    });
</script>
@endsection