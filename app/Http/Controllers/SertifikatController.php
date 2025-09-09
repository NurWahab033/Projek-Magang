<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = \App\Models\Sertifikat::with('formulir')->get();

        return view('admin.sertifikasipeserta', compact('sertifikat'));
    }

    public function terbit($id)
    {
        $sertifikat = \App\Models\Sertifikat::findOrFail($id);
        $sertifikat->update([
            'tanggal_terbit' => now()->toDateString(),
            'status' => 'tersedia',
        ]);

        return back()->with('success', 'Sertifikat berhasil diterbitkan.');
    }
}
