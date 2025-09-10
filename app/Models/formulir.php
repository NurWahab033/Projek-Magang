<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    protected $table = 'formulir'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'id',
        'nama_lengkap',
        'alamat',
        'no_telp',
        'email',
        'nama_institusi',
        'jurusan',
        'tanggal_mulai_magang',
        'tanggal_selesai_magang',
        'grade',
        'file_surat',
        'status',
        'alasan',
    ];

    protected $casts = [
        'tanggal_mulai_magang' => 'date',
        'tanggal_selesai_magang' => 'date',
    ];
    
}
