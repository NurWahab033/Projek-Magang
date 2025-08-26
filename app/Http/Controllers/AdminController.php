<?php

namespace App\Http\Controllers;
use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = FormulirPendaftaran::latest()->get();
        return view('admin.verifikasipeserta', compact('data'));
    }
    // Admin: update status (diterima/ditolak)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'alasan' => 'nullable|string|max:255',
        ]);

        $formulir = FormulirPendaftaran::findOrFail($id);

        // update status dan alasan
        $formulir->status = $request->status;
        $formulir->alasan = $request->alasan;
        $formulir->save();

    if ($formulir->status === 'diterima' && $formulir->user) {
        $formulir->user->promoteToPeserta();
    }

        return response()->json([
            'success' => true,
            'status'  => $formulir->status,
            'alasan'  => $formulir->alasan,
            'role'    => $formulir->user ? $formulir->user->role : null,
        ]);
    }


    // User: lihat informasi pendaftaran (dinamis)
    public function informasi()
    {
        $user = Auth::user();

        // Ambil data terakhir yang sesuai email user
        $formulir = FormulirPendaftaran::where('email', $user->email)
                    ->latest()
                    ->first();

        return view('user.informasi', compact('formulir'));
    }
}
