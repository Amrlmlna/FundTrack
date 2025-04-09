<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    // Menambahkan properti fillable untuk mass assignment
    protected $fillable = [
        'user_id',
        'kategori_id',
        'jumlah',
        'deskripsi',
        'tanggal',
        'batas_anggaran',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
