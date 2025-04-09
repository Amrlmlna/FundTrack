<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reminder;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $unpaidReminders = Reminder::where('user_id', $userId)->where('is_paid', false)->get();
        return view('laporan.index', compact('unpaidReminders'));
    }

    public function generate(Request $request)
    {
        $userId = Auth::id();
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $pendapatan = Pendapatan::where('user_id', $userId)->whereBetween('tanggal', [$startDate, $endDate])->get();
        $pengeluaran = Pengeluaran::where('user_id', $userId)->whereBetween('tanggal', [$startDate, $endDate])->get();

        $totalPendapatan = $pendapatan->sum('jumlah');
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $pendapatanBulanLalu = Pendapatan::where('user_id', $userId)->whereBetween('tanggal', [$previousMonthStart, $previousMonthEnd])->sum('jumlah');
        $pengeluaranBulanLalu = Pengeluaran::where('user_id', $userId)->whereBetween('tanggal', [$previousMonthStart, $previousMonthEnd])->sum('jumlah');

        $saldoBulanLalu = $pendapatanBulanLalu - $pengeluaranBulanLalu;
        $saldoSekarang = $totalPendapatan - $totalPengeluaran;

        $unpaidReminders = Reminder::where('user_id', $userId)->where('is_paid', false)->get();

        return view('laporan.index', compact(
            'pendapatan',
            'pengeluaran',
            'totalPendapatan',
            'totalPengeluaran',
            'unpaidReminders',
            'saldoBulanLalu',
            'saldoSekarang'
        ));
    }

    public function chart(Request $request)
    {
        $userId = Auth::id();
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $labels = [];
        $pendapatanData = [];
        $pengeluaranData = [];

        $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $labels[] = $date->format('Y-m-d');
            $pendapatanData[] = Pendapatan::where('user_id', $userId)->whereDate('tanggal', $date)->sum('jumlah');
            $pengeluaranData[] = Pengeluaran::where('user_id', $userId)->whereDate('tanggal', $date)->sum('jumlah');
        }

        $unpaidReminders = Reminder::where('user_id', $userId)->where('is_paid', false)->get();

        return view('laporan.chart', compact('labels', 'pendapatanData', 'pengeluaranData', 'unpaidReminders'));
    }
}
