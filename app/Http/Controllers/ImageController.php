<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    // Tampilkan halaman utama (misalnya di home.blade.php)
    public function index()
    {
        $images = Image::where('user_id', Auth::id())->get(); // hanya milik user
        $unpaidReminders = Reminder::where('is_paid', false)->get();

        return view('home', compact('images', 'unpaidReminders'));
    }

    // Tampilkan halaman semua gambar (images.index)
    public function showImages()
    {
        $images = Image::where('user_id', Auth::id())->get(); // hanya milik user
        $unpaidReminders = Reminder::where('is_paid', false)->get();

        return view('images.index', compact('images', 'unpaidReminders'));
    }

    // Upload dan simpan gambar
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Image::create([
            'user_id' => Auth::id(), // simpan ID user
            'filename' => $path
        ]);

        return back()->with('success', 'Gambar berhasil diupload!');
    }
}
