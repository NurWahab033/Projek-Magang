<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::with('formulir')->get();

        return view('admin.sertifikasipeserta', compact('sertifikat'));
    }

    public function terbit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->update([
            'tanggal_terbit' => now()->toDateString(),
            'status' => 'tersedia',
        ]);

        return back()->with('success', 'Sertifikat berhasil diterbitkan.');
    }

    public function cetak($id)
    {
        $sertifikat = Sertifikat::with('formulir', 'penilaian')->findOrFail($id);

        return view('admin.sertifikatcetak', compact('sertifikat'));
    }
}
