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
            ['name' => 'Tidak bekerja'],
            ['name' => 'PNS'],
            ['name' => 'TNI/POLRI'],
            ['name' => 'BUMN'],
            ['name' => 'Pegawai Swasta/ Wirausaha'],
            ['name' => 'lain-lain '],
        ];

        DB::table('Ref_Pekerjaans')->insert($data);
    }
}
