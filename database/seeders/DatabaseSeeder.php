<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'username' => 'admin',
            'nama_lengkap' => 'Admin',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'email' => 'admin@gmail.com',
        ]);

        User::create([
            'username' => 'killua',
            'nama_lengkap' => 'Killua Zoldyck',
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'email' => 'killua@gmail.com',
        ]);

        User::create([
            'username' => 'frieren',
            'nama_lengkap' => 'Frieren',
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'email' => 'frieren@gmail.com',
        ]);
        User::create([
            'username' => 'eve',
            'nama_lengkap' => 'Eve Antoinette',
            'password' => Hash::make('12345678'),
            'role' => 'bidan',
            'email' => 'eve@gmail.com',
        ]);
    }
}
