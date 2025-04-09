<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reminder;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use App\Models\BalanceAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReminderController extends Controller
{

    public function index()
{
    $userId = Auth::id();
    $currentMonth = Carbon::now()->month;

    $reminders = Reminder::where('user_id', $userId)
        ->whereMonth('reminder_date', $currentMonth)
        ->get();

    $unpaidReminders = Reminder::where('user_id', $userId)
        ->where('is_paid', false)
        ->whereMonth('reminder_date', $currentMonth)
        ->get();

    $balanceAlerts = BalanceAlert::where('user_id', $userId)->get();

    $totalPendapatan = Pendapatan::where('user_id', $userId)->sum('jumlah');
    $totalPengeluaran = Pengeluaran::where('user_id', $userId)->sum('jumlah');

    $saldo = $totalPendapatan - $totalPengeluaran;

    foreach ($balanceAlerts as $alert) {
        if ($saldo <= $alert->threshold_amount && !$alert->is_alerted) {
            $alert->is_alerted = true;
            $alert->save();
        }
    }

    return view('reminders.index', compact('reminders', 'balanceAlerts', 'saldo', 'unpaidReminders'));
}


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'reminder_date' => 'required|date',
    ]);

    Reminder::create([
        'title' => $request->title,
        'reminder_date' => $request->reminder_date,
        'user_id' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Pengingat berhasil ditambahkan!');
}

    public function storeBalanceAlert(Request $request)
{
    $request->validate([
        'threshold_amount' => 'required|numeric',
    ]);

    BalanceAlert::create([
        'threshold_amount' => $request->threshold_amount,
        'user_id' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Batas keuangan berhasil disimpan.');
}


public function destroy($id)
{
    $reminder = Reminder::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $reminder->delete();

    return redirect()->back()->with('success', 'Peringatan berhasil dibatalkan.');
}

public function markAsPaid($id)
{
    $reminder = Reminder::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $reminder->is_paid = true;
    $reminder->save();

    return redirect()->back()->with('success', 'Peringatan berhasil ditandai sebagai dibayar.');
}

public function markAsUnpaid($id)
{
    $reminder = Reminder::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $reminder->is_paid = false;
    $reminder->save();

    return redirect()->back()->with('success', 'Status pengingat telah dibatalkan.');
}

}
