<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CheckClock extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam',
        'status',
        'keterangan',
        'alasan',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
