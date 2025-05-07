<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPraktikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nama' => 'Praktik Kebidanan Primer'],
            ['nama' => 'Praktik Kebidanan Kolaborasi'],
            ['nama' => 'Praktik Kebidanan Rujukan'],
        ];

        DB::table('ref_jenis_praktik')->insert($data);
    }
}
