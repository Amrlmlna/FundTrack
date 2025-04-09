<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image; // Pastikan model ini ada dan sesuai
use Illuminate\Support\Facades\Auth;

class ImageUploadController extends Controller 
{
    // Metode untuk menyimpan gambar
    public function store(Request $request)
    {
        // Validasi input untuk memastikan gambar yang diupload sesuai
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar di disk public dan mendapatkan path-nya
        $path = $request->file('image')->store('images', 'public');

        // Jika Anda ingin menyimpan path gambar ke dalam database
        Image::create([
            'user_id' => Auth::id(), // user_id harus ada di tabel images
            'filename' => $path
        ]);
        
        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Gambar berhasil diupload!');
    }

    // Metode untuk mengupload gambar, jika Anda ingin memilikinya
    public function uploadImage(Request $request)
    {
        return $this->store($request); // Menggunakan metode store untuk logika yang sama
    }
}
