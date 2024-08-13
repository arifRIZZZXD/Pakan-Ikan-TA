<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Middleware\DeviceKey;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            FeedSchedulesSeeder::class,
            SettingDataSeeder::class,
            SensorTableSeeder::class,
            DeviceSeeder::class,
        ]);
    }
}
