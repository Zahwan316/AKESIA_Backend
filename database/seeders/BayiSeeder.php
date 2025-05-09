<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'id' => 6,
                'nama_lengkap' => 'Jihan',
                'jenis_kelamin' => 'P',
                'nik' => null,
                'golongan_darah' => null,
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2015-05-05',
                'no_akta_kelahiran' => null,
                'no_registrasi_kohort_bayi' => null,
                'no_registrasi_kohort_balita' => null,
                'no_catatan_medik_rs' => null,
                'anak_ke' => 1,
            ],
        ];

        //DB::table('bayis')->insert($data);
    }
}
