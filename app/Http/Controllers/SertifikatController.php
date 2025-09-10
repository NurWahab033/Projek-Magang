<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::with('formulir')->get();

        return view('admin.sertifikasipeserta', compact('sertifikat'));
    }

    public function indexPeserta()
    {
        $userId = Auth::id();

        $sertifikat = Sertifikat::with('formulir')
        ->whereHas('formulir', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->get();

        return view('peserta.cetaksertifikat', compact('sertifikat'));
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
            $sertifikat = \App\Models\Sertifikat::with([
                'formulir',
                'penilaian.user'  // Ambil user yang memberikan penilaian (PIC)
            ])->findOrFail($id);

            // PIC adalah user yang memberikan penilaian
            $pic = $sertifikat->penilaian->user ?? null;

            return view('admin.sertifikatcetak', compact('sertifikat', 'pic'));
        }

        public function cetakPeserta($id)
        {
            $sertifikat = \App\Models\Sertifikat::with([
                'formulir',
                'penilaian.user'
            ])->findOrFail($id);

            if ($sertifikat->status !== 'tersedia') {
                return redirect()->back()->with('error', 'Sertifikat belum tersedia untuk dicetak');
            }

            $pic = $sertifikat->penilaian->user ?? null;

            // Gunakan view yang sama dengan admin atau buat view khusus peserta
            return view('peserta.sertifikatcetak', compact('sertifikat', 'pic'));
        }
}
