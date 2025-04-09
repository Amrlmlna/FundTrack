<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DataUpdatedNotification;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Kategori; // Import model Kategori

class PendapatanController extends Controller
{
    public function index(Request $request)
{
    $userId = Auth::id();
    $query = Pendapatan::with('kategori')->where('user_id', $userId);

    if ($request->has('search') && $request->search != '') {
        $query->where(function ($q) use ($request) {
            $q->whereHas('kategori', function ($q2) use ($request) {
                $q2->where('nama_kategori', 'like', '%' . $request->search . '%');
            })->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->has('sort')) {
        switch ($request->sort) {
            case 'tanggal_asc': $query->orderBy('tanggal', 'asc'); break;
            case 'tanggal_desc': $query->orderBy('tanggal', 'desc'); break;
            case 'jumlah_asc': $query->orderBy('jumlah', 'asc'); break;
            case 'jumlah_desc': $query->orderBy('jumlah', 'desc'); break;
        }
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
    }

    $pendapatans = $query->get();
    $unpaidReminders = Reminder::where('user_id', $userId)->where('is_paid', false)->get();

    return view('pendapatan.index', compact('pendapatans', 'unpaidReminders'));
}


public function exportPendapatan()
{
    $userId = Auth::id();
    $pendapatans = Pendapatan::with('kategori')->where('user_id', $userId)->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Kategori');
    $sheet->setCellValue('B1', 'Jumlah');
    $sheet->setCellValue('C1', 'Tanggal');
    $sheet->setCellValue('D1', 'Deskripsi');

    $row = 2;
    foreach ($pendapatans as $pendapatan) {
        $sheet->setCellValue('A' . $row, $pendapatan->kategori->nama_kategori ?? '-');
        $sheet->setCellValue('B' . $row, $pendapatan->jumlah);
        $sheet->setCellValue('C' . $row, $pendapatan->tanggal);
        $sheet->setCellValue('D' . $row, $pendapatan->deskripsi);
        $row++;
    }

    $sheet->setTitle('Laporan Pendapatan');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="pendapatan.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}


public function show($id)
{
    $pendapatan = Pendapatan::with('kategori')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $unpaidReminders = Reminder::where('user_id', Auth::id())->where('is_paid', false)->get();

    return view('pendapatan.show', compact('pendapatan', 'unpaidReminders'));
}

public function edit($id)
{
    $pendapatan = Pendapatan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $kategoris = Kategori::all();
    $unpaidReminders = Reminder::where('user_id', Auth::id())->where('is_paid', false)->get();

    return view('pendapatan.edit', compact('pendapatan', 'kategoris', 'unpaidReminders'));
}

public function update(Request $request, $id)
{
    $pendapatan = Pendapatan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    $validatedData = $request->validate([
        'kategori_id' => 'required|exists:kategori,id',
        'jumlah' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'tanggal' => 'required|date',
    ]);

    $pendapatan->update($validatedData);
    return redirect()->route('pendapatan.index')->with('success', 'Data berhasil diperbarui!');
}

public function destroy($id)
{
    $pendapatan = Pendapatan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $pendapatan->delete();

    return redirect()->route('pendapatan.index')->with('success', 'Pendapatan berhasil dihapus.');
}

    
    public function create()
{
    $userId = Auth::id();
    $kategoris = Kategori::all(); // Kalau nanti kategori per user, tambahkan where('user_id', $userId)
    $unpaidReminders = Reminder::where('user_id', $userId)->where('is_paid', false)->get();

    return view('pendapatan.create', compact('kategoris', 'unpaidReminders'));
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);
    
        $validatedData['user_id'] = Auth::id();
    
        Pendapatan::create($validatedData);
    
        return redirect()->route('pendapatan.index')->with('success', 'Data berhasil ditambahkan!');
    }
}
