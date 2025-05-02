<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nama' => 'Tidak sekolah'],
            ['nama' => 'SD'],
            ['nama' => 'SLTP sederajat'],
            ['nama' => 'SLTA sederajat'],
            ['nama' => 'D1-D3 sederajat'],
            ['nama' => 'D4'],
            ['nama' => 'S1'],
            ['nama' => 'S2'],
            ['nama' => 'S3'],
        ];

        DB::table('Ref_Pendidikans')->insert($data);
    }
}
