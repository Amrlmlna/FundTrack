<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Kategori; // Import model Kategori

class PengeluaranController extends Controller
{
    public function index()
{
    $userId = Auth::id();
    $query = Pengeluaran::with('kategori')->where('user_id', $userId);

    // Filter: Pencarian
    if ($search = request()->get('search')) {
        $query->where(function ($q) use ($search) {
            $q->whereHas('kategori', function ($q2) use ($search) {
                $q2->where('nama_kategori', 'like', '%' . $search . '%');
            })->orWhere('deskripsi', 'like', '%' . $search . '%');
        });
    }

    // Filter: Tanggal
    if ($startDate = request()->get('start_date')) {
        $query->where('tanggal', '>=', $startDate);
    }

    if ($endDate = request()->get('end_date')) {
        $query->where('tanggal', '<=', $endDate);
    }

    // Urutan
    if ($sort = request()->get('sort')) {
        switch ($sort) {
            case 'tanggal_asc': $query->orderBy('tanggal', 'asc'); break;
            case 'tanggal_desc': $query->orderBy('tanggal', 'desc'); break;
            case 'jumlah_asc': $query->orderBy('jumlah', 'asc'); break;
            case 'jumlah_desc': $query->orderBy('jumlah', 'desc'); break;
        }
    }

    $pengeluarans = $query->get();
    $unpaidReminders = Reminder::where('user_id', $userId)->where('is_paid', false)->get();

    return view('pengeluaran.index', compact('pengeluarans', 'unpaidReminders'));
}



    public function create()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori
        $unpaidReminders = Reminder::where('is_paid', false)->get();
        return view('pengeluaran.create', compact('kategoris', 'unpaidReminders')); // Kirim kategori ke view
    }

    public function exportPengeluaran()
{
    $userId = Auth::id();
    $pengeluarans = Pengeluaran::with('kategori')->where('user_id', $userId)->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Kategori');
    $sheet->setCellValue('B1', 'Jumlah');
    $sheet->setCellValue('C1', 'Tanggal');
    $sheet->setCellValue('D1', 'Deskripsi');

    $row = 2;
    foreach ($pengeluarans as $pengeluaran) {
        $sheet->setCellValue('A' . $row, $pengeluaran->kategori->nama_kategori ?? '-');
        $sheet->setCellValue('B' . $row, $pengeluaran->jumlah);
        $sheet->setCellValue('C' . $row, $pengeluaran->tanggal);
        $sheet->setCellValue('D' . $row, $pengeluaran->deskripsi);
        $row++;
    }

    $sheet->setTitle('Laporan Pengeluaran');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="pengeluaran.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

public function show($id)
{
    $pengeluaran = Pengeluaran::where('id', $id)->where('user_id', Auth::id())->with('kategori')->firstOrFail();
    $unpaidReminders = Reminder::where('user_id', Auth::id())->where('is_paid', false)->get();

    return view('pengeluaran.show', compact('pengeluaran', 'unpaidReminders'));
}

public function edit($id)
{
    $pengeluaran = Pengeluaran::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $kategoris = Kategori::all();
    $unpaidReminders = Reminder::where('user_id', Auth::id())->where('is_paid', false)->get();

    return view('pengeluaran.edit', compact('pengeluaran', 'kategoris', 'unpaidReminders'));
}

public function update(Request $request, $id)
{
    $pengeluaran = Pengeluaran::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    $validatedData = $request->validate([
        'kategori_id' => 'required|exists:kategori,id',
        'jumlah' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'tanggal' => 'required|date',
        'batas_anggaran' => 'nullable|numeric|min:0',
    ]);

    $pengeluaran->update($validatedData);
    return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil diperbarui.');
}

public function destroy($id)
{
    $pengeluaran = Pengeluaran::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $pengeluaran->delete();

    return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus.');
}


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'kategori_id' => 'required|exists:kategori,id',
        'jumlah' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'tanggal' => 'required|date',
        'batas_anggaran' => 'nullable|numeric|min:0',
    ]);

    $validatedData['user_id'] = Auth::id();

    Pengeluaran::create($validatedData);

    return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
}

}
