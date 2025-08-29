<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanHarianController extends Controller
{
    /**
     * Tampilkan halaman laporan + riwayat
     */
public function index()
{
    $laporan = LaporanHarian::where('user_id', \Illuminate\Support\Facades\Auth::id())
        ->orderBy('tanggal_pengumpulan', 'desc')
        ->orderBy('jam_pengumpulan', 'desc')
        ->get();

    return view('peserta.laporanharian', compact('laporan')); // <- penting!
}

    /**
     * Simpan laporan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        // Upload lampiran kalau ada
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
        }

        // Simpan laporan
        LaporanHarian::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'lampiran' => $lampiranPath,
            'tanggal_pengumpulan' => now()->format('Y-m-d'),
            'jam_pengumpulan' => now()->format('H:i:s'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Tampilkan detail laporan
     */
    public function show($id)
    {
        $laporan = LaporanHarian::findOrFail($id);
        return response()->json($laporan);
    }

    /**
     * Update laporan
     */
    public function update(Request $request, $id)
    {
        $laporan = LaporanHarian::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        // Hapus lampiran lama jika ada file baru
        if ($request->hasFile('lampiran')) {
            if ($laporan->lampiran) {
                Storage::disk('public')->delete($laporan->lampiran);
            }
            $laporan->lampiran = $request->file('lampiran')->store('lampiran', 'public');
        }

        $laporan->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil diperbarui!');
    }

    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        $laporan = LaporanHarian::findOrFail($id);

        // Hapus file lampiran kalau ada
        if ($laporan->lampiran) {
            Storage::disk('public')->delete($laporan->lampiran);
        }

        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }
}
