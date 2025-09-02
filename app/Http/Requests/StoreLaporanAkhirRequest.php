<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreLaporanAkhirRequest extends FormRequest
{
    public function authorize(): bool
    {
        // hanya izinkan kalau user sedang login
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'judulLaporan' => ['required','string','max:255'],
            'fileLaporan'  => ['required','file','mimetypes:application/pdf','max:5120'],    // 5MB
            'fileDokumen'  => ['required','file','mimes:ppt,pptx','max:10240'],              // 10MB
        ];
    }

    public function attributes(): array
    {
        return [
            'judulLaporan' => 'Judul Laporan',
            'fileLaporan'  => 'File PDF',
            'fileDokumen'  => 'File PPT/PPTX',
        ];
    }
}
