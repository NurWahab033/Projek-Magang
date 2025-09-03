<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'id' => Str::uuid(),
            'role' => User::ROLE_ADMIN,
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        // PIC 1
        User::create([
            'id' => Str::uuid(),
            'role' => User::ROLE_PIC,
            'username' => 'pic_hospital',
            'email' => 'pic_hospital@gmail.com',
            'password' => Hash::make('password123'),
            'nama_institusi' => 'RS Sehat Sentosa',
        ]);

        // PIC 2
        User::create([
            'id' => Str::uuid(),
            'role' => User::ROLE_PIC,
            'username' => 'pic_university',
            'email' => 'pic_university@gmail.com',
            'password' => Hash::make('password123'),
            'nama_institusi' => 'Universitas Nusantara',
        ]);
    }
}
