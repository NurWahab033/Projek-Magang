<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    use HasFactory;

    protected $table = 'laporan_harian';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'judul',
        'isi',
        'lampiran',
        'tanggal_pengumpulan',
        'jam_pengumpulan',
        'user_id',
    ];

    // Cast field ke tipe data Laravel
    protected $casts = [
        'tanggal_pengumpulan' => 'date:Y-m-d',
        'jam_pengumpulan' => 'datetime:H:i:s',
    ];

    // Relasi ke User (foreign key: user_id)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
