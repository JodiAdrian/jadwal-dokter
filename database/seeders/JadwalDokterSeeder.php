<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class JadwalDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_dokter')->insert([
            [
                'dokter_id'   => 1,
                'day'         => 'Monday',
                'time_start'  => '08:00',
                'time_finish' => '10:00',
                'quota'       => 10,
                'status'      => true,
                'date'  => '2025-05-05',
            ],
            [
                'dokter_id'   => 1,
                'day'         => 'Monday',
                'time_start'  => '08:00',
                'time_finish' => '10:00',
                'quota'       => 10,
                'status'      => true,
                'date'  => '2025-05-12',
            ],
        ]);
    }
}
