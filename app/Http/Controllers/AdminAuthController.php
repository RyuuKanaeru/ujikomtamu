<?php

namespace App\Http\Controllers;

use App\Mail\TamuAcceptNotification;
use App\Mail\TamuPendingNotification;
use App\Mail\TamuRejectNotification;
use App\Models\Admin;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Email atau password salah.');
        }

        Session::put('is_admin_logged_in', true);
        Session::put('admin_id', $admin->id);

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di Panel Admin PTUN Bandung');
    }

    public function logout()
    {
        Session::forget('is_admin_logged_in');
        Session::forget('admin_id');
        Session::forget('admin');

        return redirect()->route('admin.login')->with('success', 'Berhasil Logout dari sistem.');
    }

    public function dashboard()
    {
        // Tampilkan hanya tamu yang status-nya null (belum di-accept, pending, atau reject)
        $tamus = BukuTamu::whereNull('status')->latest()->get();

        return view('admin.dashboard', compact('tamus'));
    }

    // ✅ Tampilkan daftar tamu yang lebih dari 1 tahun
    public function tamuLama()
    {
        $tamus = BukuTamu::where('waktu_datang', '<', now()->subYear())->get();

        return view('admin.tamu_lama', compact('tamus'));
    }

    // ✅ Hapus semua tamu yang lebih dari 1 tahun
    public function resetTamuLama()
    {
        $count = BukuTamu::where('waktu_datang', '<', now()->subYear())->delete();

        return redirect()->route('admin.tamu.lama')->with('success', "$count data tamu berhasil dihapus.");
    }

    /**
     * Accept a tamu request and send acceptance notification
     */
    public function accept($id): \Illuminate\Http\RedirectResponse
    {
        $bukuTamu = BukuTamu::findOrFail($id);

        // Update status to accepted
        $bukuTamu->update(['status' => 'accept']);

        // Send acceptance email notification
        if ($bukuTamu->email) {
            Mail::send(new TamuAcceptNotification($bukuTamu));
        }

        return redirect()->back()->with('success', "Permintaan dari {$bukuTamu->nama} telah diterima dan notifikasi email telah dikirim.");
    }

    /**
     * Reject a tamu request and send rejection notification
     */
    public function reject($id): \Illuminate\Http\RedirectResponse
    {
        $bukuTamu = BukuTamu::findOrFail($id);

        // Update status to rejected
        $bukuTamu->update(['status' => 'reject']);

        // Send rejection email notification
        if ($bukuTamu->email) {
            Mail::send(new TamuRejectNotification($bukuTamu));
        }

        return redirect()->back()->with('success', "Permintaan dari {$bukuTamu->nama} telah ditolak dan notifikasi email telah dikirim.");
    }

    /**
     * Mark a tamu request as pending and send pending notification
     */
    public function pending($id): \Illuminate\Http\RedirectResponse
    {
        $bukuTamu = BukuTamu::findOrFail($id);

        // Update status to pending
        $bukuTamu->update(['status' => 'pending']);

        // Send pending email notification
        if ($bukuTamu->email) {
            Mail::send(new TamuPendingNotification($bukuTamu));
        }

        return redirect()->back()->with('success', "Status permintaan dari {$bukuTamu->nama} diperbarui menjadi sedang diproses dan notifikasi email telah dikirim.");
    }
}
