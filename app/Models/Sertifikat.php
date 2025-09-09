<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';
    protected $fillable = [
        'formulir_id',
        'nilai',
        'nomor_sertifikat',
        'tanggal_terbit',
        'status',
    ];

    public function formulir()
    {
        return $this->belongsTo(FormulirPendaftaran::class, 'formulir_id');
    }

    // 🔹 Relasi langsung ke penilaian lewat formulir (hasOneThrough)
    public function penilaian()
    {
        return $this->hasOneThrough(
            Penilaian::class,           // model tujuan
            FormulirPendaftaran::class, // model perantara
            'id',       // kolom foreign key di tabel formulir_pendaftaran
            'user_id',  // kolom foreign key di tabel penilaian
            'formulir_id', // kolom local key di tabel sertifikat
            'user_id'   // kolom local key di tabel formulir_pendaftaran
        );
    }
}
