<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'formulir_pendaftaran';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'alamat',
        'no_telp',
        'email',
        'nama_institusi',
        'jurusan',
        'tanggal_mulai_magang',
        'tanggal_selesai_magang',
        'grade',
        'fakultas',
        'jenjang',
        'file_surat',
        'status',
        'alasan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
