@extends('layouts.app')

@section('title', 'Pendapatan')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary mb-0">
            <i class="bi bi-graph-up-arrow me-2"></i>Daftar Pendapatan
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

    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <i class="bi bi-funnel me-2"></i>
            <span>Filter dan Pencarian</span>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('pendapatan.index') }}" class="row g-3">
                <div class="col-12 col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control" placeholder="Cari kategori/deskripsi" value="{{ request()->get('search') }}">
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="">Urutkan berdasarkan</option>
                        <option value="tanggal_asc" {{ request()->get('sort') == 'tanggal_asc' ? 'selected' : '' }}>Tanggal (Asc)</option>
                        <option value="tanggal_desc" {{ request()->get('sort') == 'tanggal_desc' ? 'selected' : '' }}>Tanggal (Desc)</option>
                        <option value="jumlah_asc" {{ request()->get('sort') == 'jumlah_asc' ? 'selected' : '' }}>Jumlah (Asc)</option>
                        <option value="jumlah_desc" {{ request()->get('sort') == 'jumlah_desc' ? 'selected' : '' }}>Jumlah (Desc)</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-calendar-date"></i>
                        </span>
                        <input type="date" name="start_date" class="form-control" value="{{ request()->get('start_date') }}">
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-calendar-date"></i>
                        </span>
                        <input type="date" name="end_date" class="form-control" value="{{ request()->get('end_date') }}">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary flex-grow-1" type="submit">
                            <i class="bi bi-funnel-fill me-1"></i> Filter
                        </button>
                        <a href="{{ route('pendapatan.index') }}" class="btn btn-danger flex-grow-1">
                            <i class="bi bi-x-circle me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('pendapatan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pendapatan
        </a>
        <button id="exportBtn" class="btn btn-success">
            <i class="bi bi-file-earmark-excel me-1"></i> Ekspor Excel
        </button>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendapatans as $pendapatan)
                        <tr>
                            <td>
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                    {{ $pendapatan->kategori->nama_kategori }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ number_format($pendapatan->jumlah, 2, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($pendapatan->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $pendapatan->deskripsi }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('pendapatan.edit', $pendapatan->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('pendapatan.destroy', $pendapatan) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pendapatan ini?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
document.getElementById('exportBtn').addEventListener('click', function() {
    // Ambil data dari tabel
    var wb = XLSX.utils.table_to_book(document.getElementById('dataTable'), {sheet: "Pendapatan"});
    
    // Dapatkan worksheet untuk styling
    var ws = wb.Sheets["Pendapatan"];
    
    // Styling untuk header
    var headerRange = XLSX.utils.decode_range(ws['!ref']);
    for (let col = headerRange.s.c; col <= headerRange.e.c; col++) {
        let cell = ws[XLSX.utils.encode_cell({c: col, r: 0})]; // Mengambil cell header
        if (cell) {
            cell.s = {
                fill: {fgColor: {rgb: "3B82F6"}}, // Warna latar belakang biru
                font: {bold: true, color: {rgb: "FFFFFF"}} // Font tebal putih
            };
        }
    }
    
    // Menulis file Excel
    XLSX.writeFile(wb, 'data_pendapatan.xlsx');
});
</script>
@endsection