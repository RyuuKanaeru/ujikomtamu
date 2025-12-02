<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function form()
    {
        return view('home.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'keperluan' => 'required|string',
            'waktu_datang' => 'required|string',
            'foto_wajah' => 'required|string',
        ]);

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
                $fileName = 'foto_'.uniqid().'.'.$type;
                $filePath = 'foto_tamu/'.$fileName;
                \Storage::disk('public')->put($filePath, $base64);
                $fotoPath = $filePath;
            } else {
                return back()->withErrors(['foto_wajah' => 'Format gambar tidak valid.']);
            }
        }
        $validated['foto_wajah'] = $fotoPath;

        BukuTamu::create($validated);

        return redirect()->route('home')->with('success', 'Data berhasil disimpan!');
    }
}
