<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Penilaian;

class PicController extends Controller
{
    public function index()
    {
        $picId = Auth::id(); // id PIC yang login (UUID)

        // Tampilkan hanya peserta yang detailuser.unit == id PIC
        $pesertas = User::with(['detailuser', 'formulirPendaftaran', 'penilaian'])
            ->where('role', User::ROLE_PESERTA)
            ->whereHas('detailuser', function ($q) use ($picId) {
                $q->where('unit', $picId);
            })
            ->get();

        return view('PIC.penilaian', compact('pesertas'));
    }

    public function storePenilaian(Request $request, $user_id)
    {
        // ✅ cek otorisasi PIC
        $authorized = User::where('id', $user_id)
            ->whereHas('detailuser', function ($q) {
                $q->where('unit', Auth::id());
            })
            ->exists();

        if (! $authorized) {
            abort(403, 'Anda tidak berhak menilai peserta ini.');
        }

        // ✅ validasi input
        $request->validate([
            'penyelesaian' => 'required|integer|min:0|max:100',
            'inisiatif'    => 'required|integer|min:0|max:100',
            'komunikasi'   => 'required|integer|min:0|max:100',
            'kerjasama'    => 'required|integer|min:0|max:100',
            'kedisiplinan' => 'required|integer|min:0|max:100',
        ]);

        $rata_rata = (
            $request->penyelesaian +
            $request->inisiatif +
            $request->komunikasi +
            $request->kerjasama +
            $request->kedisiplinan
        ) / 5;

        // ✅ simpan/update penilaian
        Penilaian::updateOrCreate(
            ['user_id' => $user_id],
            [
                'pic_id'       => Auth::id(), // 👈 simpan PIC yang memberi nilai
                'penyelesaian' => $request->penyelesaian,
                'inisiatif'    => $request->inisiatif,
                'komunikasi'   => $request->komunikasi,
                'kerjasama'    => $request->kerjasama,
                'kedisiplinan' => $request->kedisiplinan,
                'rata_rata'    => $rata_rata,
                'tanggal_penilaian' => $request->tanggal_penilaian ?? now()->toDateString(),
            ]
        );

        // ✅ generate sertifikat otomatis
        $formulir = \App\Models\FormulirPendaftaran::where('user_id', $user_id)->first();

        if ($formulir) {
            $sertifikat = \App\Models\Sertifikat::firstOrNew([
                'formulir_id' => $formulir->id,
            ]);

            if (! $sertifikat->exists) {
                // Ambil nomor urut terakhir
                $lastNumber = \App\Models\Sertifikat::max('id') + 1;
                $nomorUrut = 'No' . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);

                // Format bulan.tahun (misal 09.2025)
                $monthYear = now()->format('m.Y');

                // Gabungkan format nomor sertifikat
                $nomor = $nomorUrut . '/KP.02.02/90006/' . $monthYear;

                $sertifikat->nomor_sertifikat = $nomor;
                $sertifikat->status           = 'izin terbit'; // ⬅️ tunggu tombol Terbitkan
                $sertifikat->tanggal_terbit   = null;          // ⬅️ kosong dulu
                $sertifikat->save();
            }
        }

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan dan sertifikat otomatis dibuat.');
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

}
