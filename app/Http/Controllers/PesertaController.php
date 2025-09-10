<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sertifikat;

class PesertaController extends Controller
{
    public function cetakSertifikat($id)
    {
        $userId = Auth::id();

        // Ambil sertifikat berdasarkan formulir yg dimiliki peserta ini
        $sertifikat = Sertifikat::with([
            'formulir',
            'penilaian.pic' // ambil PIC penilai
        ])
        ->whereHas('formulir', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->findOrFail($id);

        return view('peserta.sertifikatcetak', compact('sertifikat'));
    }
}
