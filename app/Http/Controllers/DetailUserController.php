<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailUser;
use App\Models\User;

class DetailUserController extends Controller
{
    /**
     * Update foto profil user yang sedang login
     */

    public function index()
    {
        // Ambil semua user dengan role = 4 (PIC)
        $picUsers = User::where('role', User::ROLE_PIC)->get();

        // Ambil peserta magang (role = 2) + detailuser
        $peserta = User::with('detailuser')->where('role', User::ROLE_PESERTA)->get();

        return view('admin.monitoringpeserta', compact('peserta', 'picUsers'));
    }
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil detail user dari user yang sedang login
        $user = Auth::user();
        $detail = $user->detailuser; // pastikan relasi ada di model User

        if (!$detail) {
            // kalau belum ada record detailuser, bisa dibuat otomatis
            $detail = new DetailUser();
            $detail->user_id = $user->id;
        }

        if ($request->hasFile('foto_profil')) {
            // Simpan file ke storage/app/public/foto_profil
            $path = $request->file('foto_profil')->store('foto_profil', 'public');

            // Update kolom di DB
            $detail->foto_profil = $path;
        }

        $detail->save();

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

        public function updateUnit(Request $request, User $user)
        {
            $request->validate([
                'unit' => 'required|uuid|exists:users,id', // karena unit diisi id PIC
            ]);

            DetailUser::updateOrCreate(
                ['user_id' => $user->id],
                ['unit' => $request->unit]
            );

            return back()->with('success', 'Unit/PIC berhasil diperbarui.');
        }

}
