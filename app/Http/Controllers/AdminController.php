<?php

namespace App\Http\Controllers;

use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

    public function createPic()
    {
        return view('admin.create-pic');
    }

    // AdminController.php
    public function storePic(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'divisi'    => 'required|string|max:100',
        ]);

        $user = \App\Models\User::create([
            'username'       => $request->nama,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'role'           => \App\Models\User::ROLE_PIC,
            'nama_institusi' => $request->divisi,
        ]);

        return redirect()->route('detailAkun')->with('success', 'Akun PIC berhasil ditambahkan');
    }


    public function detailAkun()
    {
        $pics = \App\Models\User::where('role', \App\Models\User::ROLE_PIC)->get();
        $pesertas = \App\Models\User::where('role', \App\Models\User::ROLE_PESERTA)->get();

        return view('admin.detailakun', compact('pics', 'pesertas'));
    }


    public function resetPasswordPic(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password PIC berhasil direset',
        ]);
    }
}
