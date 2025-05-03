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
            ['name' => 'Tidak sekolah'],
            ['name' => 'SD'],
            ['name' => 'SLTP sederajat'],
            ['name' => 'SLTA sederajat'],
            ['name' => 'D1-D3 sederajat'],
            ['name' => 'D4'],
            ['name' => 'S1'],
            ['name' => 'S2'],
            ['name' => 'S3'],
        ];

        DB::table('Ref_Pendidikans')->insert($data);
    }
}
