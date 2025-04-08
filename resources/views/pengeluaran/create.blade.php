@extends('layouts.app')

@section('title', 'Tambah Pengeluaran')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Pengeluaran
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pengeluaran.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-select form-select-lg" required>
                                <option value="" disabled selected>Pilih kategori pengeluaran</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-calendar-date"></i>
                                </span>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi pengeluaran"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-check-circle me-2"></i>Simpan Pengeluaran
                            </button>
                            <a href="{{ route('pengeluaran.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection