<?php
namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    // Statistik tamu
    public function statistik(Request $request)
    {
        $totalTamu = BukuTamu::count();
        $totalAccept = BukuTamu::where('status', 'accept')->count();
        $totalReject = BukuTamu::where('status', 'reject')->count();
        $today = now()->toDateString();
        $totalToday = BukuTamu::whereDate('waktu_datang', $today)->count();

        // Filter bulan dan tahun
        $selectedMonth = $request->input('bulan') ?? now()->format('m');
        $selectedYear = $request->input('tahun') ?? now()->format('Y');
        $monthYear = $selectedYear . '-' . $selectedMonth;
        $totalMonth = BukuTamu::whereRaw("DATE_FORMAT(waktu_datang, '%Y-%m') = ?", [$monthYear])->count();

        // Ambil data tamu untuk bulan & tahun terpilih
        $guestsMonth = BukuTamu::whereRaw("DATE_FORMAT(waktu_datang, '%Y-%m') = ?", [$monthYear])->orderBy('waktu_datang', 'desc')->get();

        return view('admin.statistik', compact('totalTamu', 'totalAccept', 'totalReject', 'totalToday', 'totalMonth', 'selectedMonth', 'selectedYear', 'guestsMonth'));
    }
    // Halaman daftar tamu diterima
    public function acceptPage()
    {
        $tamus = BukuTamu::where('status', 'accept')->get();
        return view('admin.accept', compact('tamus'));
    }

    // Halaman daftar tamu pending
    public function pendingPage()
    {
        $tamus = BukuTamu::where('status', 'pending')->get();
        return view('admin.pending', compact('tamus'));
    }

    // Halaman daftar tamu ditolak
    public function rejectPage()
    {
        $tamus = BukuTamu::where('status', 'reject')->get();
        return view('admin.reject', compact('tamus'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'keperluan' => 'required|string',
            'waktu_datang' => 'required|string',
            'foto_wajah' => 'required|string'
        ]);

        $data = $request->except('foto_wajah');

        // Proses foto wajah base64
        $fotoPath = null;
        if ($request->filled('foto_wajah')) {
            $base64 = $request->input('foto_wajah');
            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                $base64 = substr($base64, strpos($base64, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, etc
                $base64 = base64_decode($base64);
                if ($base64 === false) {
                    return back()->withErrors(['foto_wajah' => 'Gagal decode gambar.']);
                }
                $fileName = 'foto_' . uniqid() . '.' . $type;
                $filePath = 'foto_tamu/' . $fileName;
                Storage::disk('public')->put($filePath, $base64);
                $fotoPath = $filePath;
            } else {
                return back()->withErrors(['foto_wajah' => 'Format gambar tidak valid.']);
            }
        }
        $data['foto_wajah'] = $fotoPath;
        $data['status'] = null; // Pastikan status null agar masuk dashboard

        BukuTamu::create($data);

        return redirect()->route('tamu.form')
            ->with('success', 'Data tamu berhasil disimpan!');
    }

    public function destroy($id)
    {
        $tamu = BukuTamu::findOrFail($id);
        // Hapus foto jika ada
        if ($tamu->foto_wajah) {
            \Storage::disk('public')->delete($tamu->foto_wajah);
        }
        $tamu->delete();
        return redirect()->back()->with('success', 'Data tamu berhasil dihapus!');
    }
    // Setujui tamu
    public function accept($id)
    {
        $tamu = \App\Models\BukuTamu::findOrFail($id);
        $tamu->status = 'accept';
        $tamu->save();
        return redirect()->route('tamu.accept.page')->with('success', 'Tamu berhasil di-accept.');
    }

    // Pending tamu
    public function pending($id)
    {
        $tamu = \App\Models\BukuTamu::findOrFail($id);
        $tamu->status = 'pending';
        $tamu->save();
        return redirect()->route('tamu.pending.page')->with('success', 'Tamu berhasil dipending.');
    }

    // Tolak tamu
    public function reject($id)
    {
        $tamu = \App\Models\BukuTamu::findOrFail($id);
        $tamu->status = 'reject';
        $tamu->save();
        return redirect()->route('tamu.reject.page')->with('success', 'Tamu berhasil direject.');
    }
}
