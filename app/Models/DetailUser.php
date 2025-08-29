<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    protected $table = 'detailuser';

    protected $fillable = [
        'foto_profil',
        'unit',
    ];
}
