<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckClock;
use Illuminate\Support\Facades\Auth;

class CheckClockController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $today = now()->toDateString();

        $checkClocks = CheckClock::with('user')
            ->where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Cek apakah sudah check in / check out hari ini
        $sudahCheckIn = $checkClocks->where('tanggal', $today)
            ->where('keterangan', 'Check In')
            ->isNotEmpty();

        $sudahCheckOut = $checkClocks->where('tanggal', $today)
            ->where('keterangan', 'Check Out')
            ->isNotEmpty();

        return view('peserta.presensipeserta', compact('checkClocks', 'sudahCheckIn', 'sudahCheckOut'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $today = now()->toDateString();

        // === Validasi Check Out ===
        if ($request->keterangan === 'Check Out') {
            // Pastikan sudah ada Check In hari ini
            $checkIn = CheckClock::where('user_id', $userId)
                ->where('tanggal', $today)
                ->where('keterangan', 'Check In')
                ->first();

            if (!$checkIn) {
                return redirect()->back()->with('error', 'Anda belum melakukan Check In hari ini.');
            }

            // Pastikan belum pernah Check Out
            $alreadyOut = CheckClock::where('user_id', $userId)
                ->where('tanggal', $today)
                ->where('keterangan', 'Check Out')
                ->first();

            if ($alreadyOut) {
                return redirect()->back()->with('error', 'Anda sudah melakukan Check Out hari ini.');
            }

            // Simpan Check Out
            CheckClock::create([
                'user_id' => $userId,
                'tanggal' => $today,
                'jam' => now()->toTimeString(),
                'status' => 'Hadir',
                'keterangan' => 'Check Out',
                'alasan' => null,
            ]);

            return redirect()->route('checkclock.index')
                ->with('success', 'Check Out berhasil dicatat!');
        }

        // === Validasi Check In ===
        if ($request->keterangan === 'Check In') {
            $alreadyIn = CheckClock::where('user_id', $userId)
                ->where('tanggal', $today)
                ->where('keterangan', 'Check In')
                ->first();

            if ($alreadyIn) {
                return redirect()->back()->with('error', 'Anda sudah melakukan Check In hari ini.');
            }
        }

        // === Validasi default (Check In / Izin / Tidak Hadir) ===
        $request->validate([
            'status' => 'required|in:Hadir,Izin,Tidak Hadir',
            'keterangan' => 'required|in:Check In,Check Out',
        ]);

        // Simpan Check In / Izin / Tidak Hadir
        CheckClock::create([
            'user_id' => $userId,
            'tanggal' => $today,
            'jam' => now()->toTimeString(),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'alasan' => $request->alasan ?? null,
        ]);

        return redirect()->route('checkclock.index')
            ->with('success', 'Check In berhasil dicatat!');
    }
}
