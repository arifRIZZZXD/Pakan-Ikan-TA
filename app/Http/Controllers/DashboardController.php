<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Models\FeedSchedules;
use App\Models\SettingData;


class DashboardController extends Controller
{
    public function index()
{
    $latestSensorData = Sensor::orderBy('created_at', 'desc')->first();
    $feedMax = SettingData::first()->feedMax;  // Mengambil nilai feedMax

    // Ambil hanya 10 data terbaru dari tabel 'sensors'
    $sales = Sensor::orderBy('created_at', 'desc')->take(10)->get();
    
    // Urutkan kembali data agar grafik menunjukkan waktu secara urut
    $sales = $sales->sortBy('created_at');
    
    // Buat data untuk Chart.js
    $data1 = [
        'labels' => $sales->pluck('created_at')->map(function ($date) {
            return $date ? $date->format('H:i:s') : 'N/A'; // Format tanggal sesuai kebutuhan
        }),
        'datasets' => [
            [
                'label' => 'Suhu',
                'backgroundColor' => 'rgba(0, 0, 0, 0)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'data' => $sales->pluck('temp'),
            ],
        ],
    ];

    $data2 = [
        'labels' => $sales->pluck('created_at')->map(function ($date) {
            return $date ? $date->format('H:i:s') : 'N/A'; // Format tanggal sesuai kebutuhan
        }),
        'datasets' => [
            [
                'label' => 'pH',
                'backgroundColor' => 'rgba(0, 0, 0, 0)',
                'borderColor' => 'rgba(0, 0, 255, 0.6)',
                'data' => $sales->pluck('ph'),
            ],
        ],
    ];

    // Ambil jadwal feed selanjutnya
    $nextFeedSchedule = $this->getNextFeedSchedule();

    return view('admin.dashboards.index', compact('data1', 'data2', 'latestSensorData', 'nextFeedSchedule', 'feedMax'));
}

    private function getNextFeedSchedule()
    {
        $now = Carbon::now('Asia/Jakarta');
        $feedSchedules = FeedSchedules::all();
        $nextFeedTime = null;

        foreach ($feedSchedules as $schedule) {
            for ($i = 1; $i <= 3; $i++) {
                $feedTime = Carbon::createFromTime($schedule->{"jam$i"}, $schedule->{"menit$i"}, 0, 'Asia/Jakarta');

                if ($feedTime->greaterThan($now)) {
                    if (is_null($nextFeedTime) || $feedTime->lessThan($nextFeedTime)) {
                        $nextFeedTime = $feedTime;
                    }
                }
            }
        }

        // Jika tidak ada jadwal feed selanjutnya, return null
        return $nextFeedTime ?: 'sudah tidak ada';
    }

    public function getLatestSensorData()
{
    $latestSensorData = Sensor::orderBy('created_at', 'desc')->first();
    $feedMax = SettingData::first()->feedMax;
    $sales = Sensor::orderBy('created_at', 'desc')->take(10)->get()->sortBy('created_at');

    $data1 = [
        'labels' => $sales->pluck('created_at')->map(function ($date) {
            return $date->format('H:i:s');
        }),
        'datasets' => [
            [
                'label' => 'temp',
                'backgroundColor' => 'rgba(0, 0, 0, 0)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'data' => $sales->pluck('temp'),
            ],
        ],
    ];

    $data2 = [
        'labels' => $sales->pluck('created_at')->map(function ($date) {
            return $date->format('H:i:s');
        }),
        'datasets' => [
            [
                'label' => 'pH',
                'backgroundColor' => 'rgba(0, 0, 0, 0)',
                'borderColor' => 'rgba(0, 0, 255, 0.6)',
                'data' => $sales->pluck('ph'),
            ],
        ],
    ];

    return response()->json([
        'latestSensorData' => $latestSensorData,
        'data1' => $data1,
        'data2' => $data2,
        'feedMax' => $feedMax,
    ]);
}
}