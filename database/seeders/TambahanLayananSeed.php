<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TambahanLayananSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'Hair Lotion Minyak Kemiri',
                'harga' => 5000,
            ],
            [
                'name' => 'ORAL HIEGINE BABY',
                'harga' => 20000,
            ],
            [
                'name' => 'UAP NEBULIZER',
                'harga' => 45000,
            ],
            [
                'name' => 'UAP DIFUSER YL',
                'harga' => 40000,
            ],
            [
                'name' => 'SINAR MOKSA',
                'harga' => 20000,
            ],
            [
                'name' => 'MANDIKAN BAYI (DATANG)',
                'harga' => 60000,
            ],
            [
                'name' => 'TERAPI BALUR YL',
                'harga' => 20000,
            ],
            [
                'name' => 'CUKUR GUNDUL BAYI',
                'harga' => 100000,
            ],
            [
                'name' => 'TINDIK BAYI <3 BULAN BIDAN RHITA',
                'harga' => 85000,
            ],
            [
                'name' => 'SWIMM HYDROTERAPHY',
                'harga' => 75000,
            ],
            [
                'name' => 'BABY GYM',
                'harga' => 25000,
            ],
            [
                'name' => 'BABY MASSAGE',
                'harga' => 70000,
            ],
            [
                'name' => 'ONGKOS TRANSPORT < 5 KM',
                'harga' => 15000,
            ],
            [
                'name' => 'ONGKOS TRANSPORT 5 - 10 KM',
                'harga' => 25000,
            ],
        ];

        DB::table('tambahan_layanans')->insert($data);
    }
}
