<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeedSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'jam1' => 7,
            'menit1' => 35,
            'jam2' => 12,
            'menit2' => 45,
            'jam3' => 18,
            'menit3' => 35,
        ];

        DB::table('feed_schedules')->insert($data);
    }
}
