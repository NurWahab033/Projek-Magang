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
        // Pastikan PIC hanya bisa menilai peserta yang "unit"-nya == id PIC
        $authorized = User::where('id', $user_id)
            ->whereHas('detailuser', function ($q) {
                $q->where('unit', Auth::id());
            })
            ->exists();

        if (! $authorized) {
            abort(403, 'Anda tidak berhak menilai peserta ini.');
        }

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
