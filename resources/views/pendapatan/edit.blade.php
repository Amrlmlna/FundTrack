@extends('layouts.app')

@section('title', 'Edit Pendapatan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>Edit Pendapatan
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pendapatan.update', $pendapatan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-select form-select-lg" required>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $kategori->id == $pendapatan->kategori_id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $pendapatan->jumlah }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-calendar-date"></i>
                                </span>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pendapatan->tanggal }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $pendapatan->deskripsi }}</textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle me-2"></i>Perbarui Pendapatan
                            </button>
                            <a href="{{ route('pendapatan.index') }}" class="btn btn-outline-secondary">
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