<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'pic_id',
        'user_id',
        'penyelesaian',
        'inisiatif',
        'komunikasi',
        'kerjasama',
        'kedisiplinan',
        'rata_rata',
        'tanggal_penilaian',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

// App\Models\Penilaian.php
        public function pic()
        {
            return $this->belongsTo(User::class, 'pic_id', 'id');
        }


}
