<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // bikin user admin default
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // cek biar tidak dobel
            [
                'name' => 'Super Admin',
                'username' => 'admin',
                'password' => Hash::make('admin123'), // password default
                'role' => 'admin',
                'created_by' => null,
                'updated_by' => null,
            ]
        );
    }
}
