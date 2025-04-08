<?php

use App\Mail\TestEmail;
use App\Http\Controllers\ImageUploadController;
use App\Exports\PendapatanExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\DataUpdatedNotification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\BalanceAlertController;
use App\Http\Controllers\AuthController; // Tambahkan ini

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Protected routes - tambahkan middleware auth
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Existing routes that need authentication
    Route::resource('pendapatan', PendapatanController::class);
    Route::get('pendapatan/{id}', [PendapatanController::class, 'show'])->name('pendapatan.show');
    Route::get('/pendapatan/export', [PendapatanController::class, 'exportPendapatan'])->name('pendapatan.export');
    Route::get('pengeluaran/export', [PengeluaranController::class, 'export'])->name('pengeluaran.export');

    Route::resource('pengeluaran', PengeluaranController::class);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('laporan/generate', [LaporanController::class, 'generate'])->name('laporan.generate');
    Route::get('laporan/chart', [LaporanController::class, 'chart'])->name('laporan.chart');

    Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
    Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
    Route::post('/reminders/{id}/mark-as-paid', [ReminderController::class, 'markAsPaid'])->name('reminders.markAsPaid');
    Route::post('/balance-alerts', [ReminderController::class, 'storeBalanceAlert'])->name('balanceAlerts.store');
    Route::post('/reminders/{id}/cancel', [BalanceAlertController::class, 'cancelReminder'])->name('reminders.cancel');
    Route::post('/balance-alerts/cancel', [BalanceAlertController::class, 'cancelBalanceAlert'])->name('balanceAlerts.cancel');
    Route::post('/balance-alerts/delete/{id}', [BalanceAlertController::class, 'delete'])->name('balanceAlerts.delete');
    Route::get('/home', [App\Http\Controllers\ImageController::class, 'index'])->name('home');
    Route::get('/images', [ImageController::class, 'showImages'])->name('images.list');
    Route::post('/upload-image', [ImageUploadController::class, 'store'])->name('upload.image');
    Route::post('/reminders/{id}/mark-as-unpaid', [ReminderController::class, 'markAsUnpaid'])->name('reminders.markAsUnpaid');
});

// Email testing routes - keep these outside auth middleware if needed for testing
Route::get('/send-test-email', function () {
    $details = [
        'title' => 'Test Email from Laravel',
        'body' => 'This is a test email sent using SendGrid in Laravel.'
    ];

    Mail::to('belajarlaravel11@gmail.com')->send(new \App\Mail\TestEmail($details));

    return 'Email has been sent';
});