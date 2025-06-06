<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['name' => 'Pemeriksaan Ibu Hamil'],
            ['name' => 'Pelayanan Bersalin'],
            ['name' => 'Pelayanan Nifas'],
            ['name' => 'Pelayanan Bayi'],
            ['name' => 'Pelayanan Lainnya'],
        ];

        DB::table('Ref_jenis_form')->insert($data);
    }
}
