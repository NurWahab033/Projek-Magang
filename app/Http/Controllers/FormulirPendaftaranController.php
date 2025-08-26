<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormulirPendaftaranController extends Controller
{
    // Tampilkan form pendaftaran ke user
    public function create()
    {
    $user = Auth::user(); // ambil data user yang sedang login

    // Cek apakah user sudah pernah mengisi formulir
    $sudahDaftar = FormulirPendaftaran::where('email', $user->email)->exists();

    if ($sudahDaftar) {
        // Jika sudah daftar, kirim pop-up alert lalu redirect
        return redirect()->back()->with('alert', 'Anda sudah mengisi formulir, harap menunggu respon dari admin.');
    }

    // Jika belum pernah daftar, tampilkan form
    return view('user.magangform', compact('user'));
    }

    // Simpan data pendaftaran dari user
public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_telp' => 'required|string|max:20',
        'email' => 'required|email',
        'nama_institusi' => 'required|string|max:255',
        'jurusan' => 'required|string|max:255',
        'tanggal_mulai_magang' => 'required|date',
        'tanggal_selesai_magang' => 'required|date|after_or_equal:tanggal_mulai_magang',
        'grade' => 'required|in:Mahasiswa,Siswa',
        'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Simpan file surat
    $filePath = $request->file('file_surat')->store('uploads', 'public');

    // Cek data sebelum insert
    // dd([
    //     'user_id' => Auth::id(),
    //     'nama_lengkap' => $request->nama_lengkap,
    //     'alamat' => $request->alamat,
    //     'no_telp' => $request->no_telp,
    //     'email' => $request->email,
    //     'nama_institusi' => $request->nama_institusi,
    //     'jurusan' => $request->jurusan,
    //     'tanggal_mulai_magang' => $request->tanggal_mulai_magang,
    //     'tanggal_selesai_magang' => $request->tanggal_selesai_magang,
    //     'grade' => $request->grade,
    //     'file_surat' => $filePath,
    //     'status' => 'menunggu',
    // ]);

    // Kalau sudah yakin, baru simpan ke DB
    FormulirPendaftaran::create([
        'user_id' => Auth::id(),
        'nama_lengkap' => $request->nama_lengkap,
        'alamat' => $request->alamat,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
        'nama_institusi' => $request->nama_institusi,
        'jurusan' => $request->jurusan,
        'tanggal_mulai_magang' => $request->tanggal_mulai_magang,
        'tanggal_selesai_magang' => $request->tanggal_selesai_magang,
        'grade' => $request->grade,
        'file_surat' => $filePath,
        'status' => 'menunggu',
    ]);

    return redirect('/user')->with('success', 'Formulir berhasil disimpan.');
}

}
