<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ExportController;

// Default route langsung ke form
Route::get('/', [UserController::class, 'form'])->name('home');

Route::get('/welcome', function () { 
    return view('home.welcome');
})->name('welcome');

Route::get('/about', function () { 
    return view('home.about');
})->name('about');

Route::get('/kontak', function () {
    return view('home.kontak');
})->name('kontak');

// Admin logout route
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// User form routes
Route::post('/tamu', [HomeController::class, 'store'])->name('tamu.store');
Route::delete('/tamu/{id}', [HomeController::class, 'destroy'])->name('tamu.destroy');

// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Panel (protected by middleware)
Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');

    // Export PDF Buku Tamu Bulanan
    Route::get('/buku-tamu/export-pdf', [ExportController::class, 'exportBukuTamuPerBulan'])->name('admin.buku-tamu.export-pdf');

    // Halaman untuk melihat data tamu lama (> 1 tahun)
    Route::get('/tamu-lama', [AdminAuthController::class, 'tamuLama'])->name('admin.tamu.lama');

    // Hapus semua tamu lama (> 1 tahun)
    Route::delete('/tamu-lama/delete', [AdminAuthController::class, 'resetTamuLama'])->name('admin.reset.tamu');

    // Halaman status tamu
    Route::get('/statistik', [HomeController::class, 'statistik'])->name('admin.statistik');
    Route::get('/accept', [HomeController::class, 'acceptPage'])->name('tamu.accept.page');
    Route::get('/pending', [HomeController::class, 'pendingPage'])->name('tamu.pending.page');
    Route::get('/reject', [HomeController::class, 'rejectPage'])->name('tamu.reject.page');
});

// Aksi status tamu
Route::post('/tamu/{id}/accept', [HomeController::class, 'accept'])->name('tamu.accept');
Route::post('/tamu/{id}/pending', [HomeController::class, 'pending'])->name('tamu.pending');
Route::post('/tamu/{id}/reject', [HomeController::class, 'reject'])->name('tamu.reject');
