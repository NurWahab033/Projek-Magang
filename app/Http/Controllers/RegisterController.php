<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    // Tampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('kredensial.register');
    }
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'gmail' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'nama_institusi' => 'required|string|max:46', // jika sekolah boleh kosong
        ]);

        // Simpan ke tabel users
        User::create([
            'id' => Str::uuid(),
            'username' => $request->username,
            'email' => $request->gmail,
            'password' => Hash::make($request->password),
            'nama_institusi' => $request->nama_institusi,
            'role' => 3,
        ]);

        return redirect('/login')->with('success', 'Berhasil daftar, silakan login.');
    }
}
