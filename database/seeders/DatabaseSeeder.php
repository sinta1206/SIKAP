<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus atau komentari bagian factory bawaan seperti ini:
        // \App\Models\User::factory(10)->create();

        // Panggil UserSeeder kita saja:
        $this->call([
            UserSeeder::class,
        ]);
    }
}
