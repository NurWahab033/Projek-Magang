<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailUser;

class MonitoringController extends Controller
{
    public function index()
    {
        // Ambil semua peserta magang beserta detail & formulir pendaftaran
        $pesertas = User::with(['detailuser', 'formulirPendaftaran'])
            ->where('role', User::ROLE_PESERTA)
            ->get();

        // Ambil hanya user dengan role PIC
        $picUsers = User::where('role', User::ROLE_PIC)->get();

        return view('admin.monitoringpeserta', compact('pesertas', 'picUsers'));
    }

    public function updateUnit(Request $request, $id)
    {
        $request->validate([
            'unit' => 'nullable|exists:users,id', // unit = user_id PIC
        ]);

        $peserta = User::findOrFail($id);

        // Update atau buat detailuser
        DetailUser::updateOrCreate(
            ['user_id' => $peserta->id],
            ['unit' => $request->unit]
        );

        return redirect()->back()->with('success', 'PIC berhasil diperbarui.');
    }

    public function deleteUnit($id)
    {
        $peserta = User::findOrFail($id);

        // Jika ada detailuser maka hapus kolom unit-nya
        if ($peserta->detailuser) {
            $peserta->detailuser->update(['unit' => null]);
        }

        return redirect()->back()->with('success', 'PIC berhasil dihapus dari peserta.');
    }

}
