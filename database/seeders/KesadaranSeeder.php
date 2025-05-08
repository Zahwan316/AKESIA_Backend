<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KesadaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['name' => 'Sadar Baik/Alert'],
            ['name' => 'Berespon dengan kata-kata/Voice'],
            ['name' => 'Hanya berespons jika dirangsang nyeri/pain'],
            ['name' => 'Pasien tidak sadar/unresponsive'],
            ['name' => 'Gelisah atau bingung'],
            ['name' => 'Acute Confusional States'],
        ];

        DB::table('Ref_Kesadaran')->insert($data);
    }
}
