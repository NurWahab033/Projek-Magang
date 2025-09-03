<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penilaian;

class PicController extends Controller
{
    public function index()
    {
        // Ambil hanya user dengan role peserta (2) beserta relasi detailuser dan formulir
        $pesertas = User::with(['detailuser', 'formulirPendaftaran'])
                        ->where('role', User::ROLE_PESERTA)
                        ->get();

        return view('PIC.penilaian', compact('pesertas'));
    }

        public function storePenilaian(Request $request, $user_id)
    {
        $request->validate([
            'penyelesaian' => 'required|integer|min:0|max:100',
            'inisiatif'    => 'required|integer|min:0|max:100',
            'komunikasi'   => 'required|integer|min:0|max:100',
            'kerjasama'    => 'required|integer|min:0|max:100',
            'kedisiplinan' => 'required|integer|min:0|max:100',
        ]);

        // Hitung rata-rata
        $rata_rata = (
            $request->penyelesaian +
            $request->inisiatif +
            $request->komunikasi +
            $request->kerjasama +
            $request->kedisiplinan
        ) / 5;

        // Simpan atau update jika sudah ada penilaian untuk user ini
        Penilaian::updateOrCreate(
            ['user_id' => $user_id],
            [
                'penyelesaian' => $request->penyelesaian,
                'inisiatif'    => $request->inisiatif,
                'komunikasi'   => $request->komunikasi,
                'kerjasama'    => $request->kerjasama,
                'kedisiplinan' => $request->kedisiplinan,
                'rata_rata'    => $rata_rata,
            ]
        );

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan.');
    }
}
