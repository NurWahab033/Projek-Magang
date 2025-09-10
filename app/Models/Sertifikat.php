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
        Penilaian::class,
        FormulirPendaftaran::class,
        'id',       // Foreign key on Formulir
        'user_id',  // Foreign key on Penilaian
        'formulir_id', // Local key on Sertifikat
        'user_id'   // Local key on Formulir
    );
}


}
