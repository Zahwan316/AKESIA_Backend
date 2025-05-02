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
            'username' => 'killua',
            'nama_lengkap' => 'Killua Zoldyck',
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'email' => 'killua@gmail.com',
        ],

    );
        User::create([
            'username' => 'frieren',
            'nama_lengkap' => 'Frieren',
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'email' => 'frieren@gmail.com',
        ]);
    }
}
