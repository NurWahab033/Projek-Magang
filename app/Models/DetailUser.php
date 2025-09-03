<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    protected $table = 'detailuser';

    protected $fillable = [
        'user_id',
        'foto_profil',
        'unit',
    ];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pic()
    {
        return $this->belongsTo(User::class, 'unit'); // unit = UUID user PIC
    }

}
