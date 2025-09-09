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
}
