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
        return view('user.formpendaftaran', compact('user'));
    }

    // Simpan data pendaftaran dari user
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email',
            'nama_institusi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_mulai_magang' => 'required|date',
            'tanggal_selesai_magang' => 'required|date|after_or_equal:tanggal_mulai_magang',
            'grade' => 'required|in:Mahasiswa,Siswa',
            'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048',
            // Validasi fakultas & jenjang hanya jika Mahasiswa
            'fakultas' => $request->grade === 'Mahasiswa' ? 'required|string|max:255' : 'nullable',
            'jenjang'  => $request->grade === 'Mahasiswa' ? 'required|in:S1,S2' : 'nullable',
        ]);

        // Simpan file surat
        $filePath = $request->file('file_surat')->store('uploads', 'public');

        // Ambil data yang akan disimpan ke DB
        $data = $request->only([
            'nama_lengkap', 'alamat', 'no_telp', 'email', 'nama_institusi',
            'jurusan', 'tanggal_mulai_magang', 'tanggal_selesai_magang', 'grade'
        ]);

        // Tambahkan fakultas & jenjang hanya jika Mahasiswa
        if ($request->grade === 'Mahasiswa') {
            $data['fakultas'] = $request->fakultas;
            $data['jenjang'] = $request->jenjang;
        } else {
            $data['fakultas'] = null;
            $data['jenjang'] = null;
        }

        // Tambahkan data tambahan
        $data['user_id'] = Auth::id();
        $data['file_surat'] = $filePath;
        $data['status'] = 'menunggu';

        // Simpan ke DB
        FormulirPendaftaran::create($data);

        return redirect('/user')->with('success', 'Formulir berhasil disimpan.');
    }
}
