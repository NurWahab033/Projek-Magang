<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailUser;

class DetailUserController extends Controller
{
    /**
     * Update foto profil user yang sedang login
     */
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
}
