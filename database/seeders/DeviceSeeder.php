<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deviceKey = '12345';

        $now = Carbon::now();

        DB::table('devices')->insert([
            'deviceKey' => $deviceKey,
            'lastChecked_at' => $now,
            'isActive' => true, 
        ]);
    }
}
