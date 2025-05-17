<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dokter')->insert([
            ['nama_dokter' => 'Dr. Siti'],
            ['nama_dokter' => 'Dr. Budi'],
            ['nama_dokter' => 'Dr. Rani'],
        ]);

    }
}
