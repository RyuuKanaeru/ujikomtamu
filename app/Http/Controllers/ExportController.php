<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportBukuTamuPerBulan(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->format('m');
        $tahun = $request->input('tahun') ?? now()->format('Y');
        $monthYear = $tahun . '-' . $bulan;
        $guestsMonth = BukuTamu::whereRaw("DATE_FORMAT(waktu_datang, '%Y-%m') = ?", [$monthYear])
            ->orderBy('waktu_datang', 'desc')
            ->get()
            ->map(function($guest) {
                if ($guest->foto_wajah) {
                    // Get correct path
                    $path = storage_path('app/public/' . $guest->foto_wajah);
                    
                    // Try multiple path variations if file doesn't exist
                    if (!file_exists($path)) {
                        $alternativePaths = [
                            storage_path('app/public/storage/' . $guest->foto_wajah),
                            public_path('storage/' . $guest->foto_wajah),
                            storage_path('app/' . $guest->foto_wajah)
                        ];
                        
                        foreach ($alternativePaths as $altPath) {
                            if (file_exists($altPath)) {
                                $path = $altPath;
                                break;
                            }
                        }
                    }

                    if (file_exists($path)) {
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $guest->foto_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }
                }
                return $guest;
            });

        $pdf = PDF::loadView('admin.pdf_buku_tamu', [
            'guestsMonth' => $guestsMonth,
            'bulan' => $bulan,
            'tahun' => $tahun
        ])->setPaper('a4', 'landscape');
        $filename = 'buku_tamu_' . $bulan . '_' . $tahun . '.pdf';
        return $pdf->stream($filename);
    }
}
