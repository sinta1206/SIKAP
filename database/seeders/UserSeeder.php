<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        // Akun untuk Pegawai Desa
        User::create([
            'username' => 'pegawai_desa',
            'password' => Hash::make('pegawai123'),
            'role'     => 'pegawai_desa',
        ]);

        // Akun untuk Panitia Pemilu
        User::create([
            'username' => 'panitia_pemilu',
            'password' => Hash::make('panitia123'),
            'role'     => 'panitia_pemilu',
        ]);
    }
}
