<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'suhu' => 30,
            'pH' => 6,3,
            'pakan' => 6.0,
        ];

        DB::table('sensors')->insert($data);
    }
}
