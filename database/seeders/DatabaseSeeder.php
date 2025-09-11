<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus semua user lama untuk menghindari duplikasi
        // User::truncate(); // Hati-hati menggunakan ini di produksi

        // Buat 1 User sebagai Admin
        User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'), // Ganti dengan password yang aman
        ]);

        // Buat 10 User biasa
        User::factory(10)->create();
    }
}