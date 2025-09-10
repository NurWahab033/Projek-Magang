<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;

class CetakSertifikatController extends Controller
{
    /**
     * Menampilkan halaman cetak sertifikat untuk peserta
     */
    public function cetakPeserta($id)
    {
        $sertifikat = Sertifikat::with([
            'formulirPendaftaran', // untuk nama & institusi
            'penilaian.user'       // untuk PIC
        ])->findOrFail($id);

        if ($sertifikat->status !== 'tersedia') {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia untuk dicetak.');
        }

        $pic = $sertifikat->penilaian->user ?? null;

        // Merujuk ke file view peserta/cetaksertifikat.blade.php
        return view('peserta.cetaksertifikat', compact('sertifikat', 'pic'));
    }

    /**
     * Jika ingin buat versi admin
     */
    public function cetakAdmin($id)
    {
        $sertifikat = Sertifikat::with([
            'formulirPendaftaran',
            'penilaian.user'
        ])->findOrFail($id);

        return view('admin.sertifikatcetak', compact('sertifikat'));
    }

        public function show($id)
    {
        $sertifikat = Sertifikat::with(['formulir', 'penilaian.user'])->findOrFail($id);

        // Pastikan sertifikat sudah diterbitkan
        if ($sertifikat->status !== 'tersedia') {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia.');
        }

        return view('peserta.cetaksertifikat', compact('sertifikat'));
    }
}
