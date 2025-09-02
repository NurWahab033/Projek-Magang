<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaporanAkhirRequest;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LaporanAkhirController extends Controller
{
    /**
     * Tampilkan daftar laporan akhir user yang sedang login.
     */
    public function index()
    {
        $laporans = LaporanAkhir::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('peserta.laporan-akhir', compact('laporans'));
    }

    /**
     * Simpan laporan akhir baru (PDF + PPT).
     */
    public function store(StoreLaporanAkhirRequest $request)
    {
        $user = Auth::user();
        $dir  = "laporan-akhir/{$user->id}";

        // Simpan file PDF
        $pdfFile = $request->file('fileLaporan');
        $pdfName = now()->format('Ymd_His') . '_' . Str::slug(pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $pdfFile->getClientOriginalExtension();
        $pdfPath = $pdfFile->storeAs($dir, $pdfName, 'public');

        // Simpan file PPT
        $pptFile = $request->file('fileDokumen');
        $pptName = now()->format('Ymd_His') . '_' . Str::slug(pathinfo($pptFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $pptFile->getClientOriginalExtension();
        $pptPath = $pptFile->storeAs($dir, $pptName, 'public');

        // Simpan ke database
        LaporanAkhir::create([
            'user_id'       => $user->id,
            'judul'         => $request->input('judulLaporan'),
            'file_pdf_path' => $pdfPath,
            'file_ppt_path' => $pptPath,
            'status'        => 'Terkirim',
        ]);

        return redirect()
            ->route('laporan-akhir.index')
            ->with('success', 'Laporan akhir berhasil diunggah.');
    }

    /**
     * Download file laporan akhir (PDF / PPT).
     */
    public function download(LaporanAkhir $laporan, string $type): BinaryFileResponse
    {
        abort_unless($laporan->user_id === Auth::id(), 403);

        return match ($type) {
            'pdf' => response()->download(Storage::disk('public')->path($laporan->file_pdf_path)),
            'ppt' => response()->download(Storage::disk('public')->path($laporan->file_ppt_path)),
            default => abort(404),
        };
    }
}
