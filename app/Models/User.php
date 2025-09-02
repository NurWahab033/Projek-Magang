<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 1;
    public const ROLE_PESERTA = 2;
    public const ROLE_PENDAFTAR = 3;
    public const ROLE_PIC = 4;

    // 🔑 Wajib supaya id UUID terbaca string, bukan int
    public $incrementing = false;
    protected $keyType = 'string';

    // 🔑 Generate UUID otomatis saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public static function getRoleName(int $role): string
    {
        return match ($role) {
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_PESERTA => 'Peserta',
            self::ROLE_PENDAFTAR => 'Pendaftar',
            self::ROLE_PIC => 'PIC',
            default => 'Tidak diketahui',
        };
    }

    public function getRoleLabelAttribute(): string
    {
        return self::getRoleName($this->role);
    }

    protected $fillable = [
        'id',
        'role',
        'username',
        'email',
        'password',
        'nama_institusi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function promoteToPeserta()
    {
        $this->update(['role' => self::ROLE_PESERTA]);
    }

    public function detailuser()
    {
        return $this->hasOne(DetailUser::class, 'user_id');
    }
    public function formulirPendaftaran()
    {
        return $this->hasOne(FormulirPendaftaran::class, 'user_id', 'id');
    }

    public function checkClocks()
    {
        return $this->hasMany(CheckClock::class, 'user_id');
    }
}
