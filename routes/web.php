<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Default halaman → Welcome
Route::get('/', function () {
    return view('home.welcome');
})->name('home');

// Halaman tambahan
Route::view('/welcome', 'home.welcome')->name('welcome');
Route::view('/about', 'home.about')->name('about');
Route::view('/kontak', 'home.kontak')->name('kontak');

/*
|--------------------------------------------------------------------------
| Form Tamu (User)
|--------------------------------------------------------------------------
*/

// Halaman form tamu
Route::get('/tamu', [UserController::class, 'form'])->name('tamu.form');

// Submit form tamu
Route::post('/tamu', [HomeController::class, 'store'])->name('tamu.store');

// Hapus data tamu
Route::delete('/tamu/{id}', [HomeController::class, 'destroy'])->name('tamu.destroy');

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Panel (Protected with Middleware)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {

    // Dashboard
    Route::get('/', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');

    // Export PDF Buku Tamu per Bulan
    Route::get('/buku-tamu/export-pdf', 
        [ExportController::class, 'exportBukuTamuPerBulan']
    )->name('admin.buku-tamu.export-pdf');

    // Data tamu lama (> 1 tahun)
    Route::get('/tamu-lama', [AdminAuthController::class, 'tamuLama'])
        ->name('admin.tamu.lama');

    Route::delete('/tamu-lama/delete', [AdminAuthController::class, 'resetTamuLama'])
        ->name('admin.reset.tamu');

    // Status tamu
    Route::get('/statistik', [HomeController::class, 'statistik'])->name('admin.statistik');
    Route::get('/accept', [HomeController::class, 'acceptPage'])->name('tamu.accept.page');
    Route::get('/pending', [HomeController::class, 'pendingPage'])->name('tamu.pending.page');
    Route::get('/reject', [HomeController::class, 'rejectPage'])->name('tamu.reject.page');
});

/*
|--------------------------------------------------------------------------
| Aksi Status Tamu
|--------------------------------------------------------------------------
*/

Route::post('/tamu/{id}/accept', [HomeController::class, 'accept'])->name('tamu.accept');
Route::post('/tamu/{id}/pending', [HomeController::class, 'pending'])->name('tamu.pending');
Route::post('/tamu/{id}/reject', [HomeController::class, 'reject'])->name('tamu.reject');
