<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan view ini ada
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Deteksi role dan redirect sesuai
            switch ($user->role) {
                case 1:
                    return redirect()->intended('/admin')
                        ->with('success', 'Login berhasil, selamat datang Admin SDM!');
                case 2:
                    return redirect()->intended('/peserta')
                        ->with('success', 'Login berhasil, selamat datang Peserta!');
                case 3:
                    return redirect()->intended('/user')
                        ->with('success', 'Login berhasil, selamat datang, mohon daftarkan diri anda!');
                case 4:
                    return redirect()->intended('/PIC')
                        ->with('success', 'Login berhasil, selamat datang');
                default:
                    Auth::logout();
                    return redirect('/login')
                        ->withErrors(['email' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
