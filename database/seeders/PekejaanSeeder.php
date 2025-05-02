<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekejaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nama' => 'Tidak bekerja'],
            ['nama' => 'PNS'],
            ['nama' => 'TNI/POLRI'],
            ['nama' => 'BUMN'],
            ['nama' => 'Pegawai Swasta/ Wirausaha'],
            ['nama' => 'lain-lain '],
        ];

        DB::table('ref_pekerjaans')->insert($data);
    }
}
