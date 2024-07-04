<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $latestSensorData = Sensor::orderBy('created_at', 'desc')->first();

        // Ambil hanya 10 data terbaru dari tabel 'sensors'
        $sales = Sensor::orderBy('created_at', 'desc')->take(10)->get();
        
        // Urutkan kembali data agar grafik menunjukkan waktu secara urut
        $sales = $sales->sortBy('created_at');
        
        // Buat data untuk Chart.js
        $data1 = [
            'labels' => $sales->pluck('created_at')->map(function ($date) {
                return $date->format('H:i:s'); // Format tanggal sesuai kebutuhan
            }),
            'datasets' => [
                [
                    'label' => 'Suhu',
                    'backgroundColor' => 'rgba(0, 0, 0, 0)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'data' => $sales->pluck('suhu'),
                ],
            ],
        ];

        $data2 = [
            'labels' => $sales->pluck('created_at')->map(function ($date) {
                return $date->format('H:i:s'); // Format tanggal sesuai kebutuhan
            }),
            'datasets' => [
                [
                    'label' => 'ph',
                    'backgroundColor' => 'rgba(0, 0, 0, 0)',
                    'borderColor' => 'rgba(0, 0, 255, 0.6)',
                    'data' => $sales->pluck('ph'),
                ],
            ],
        ];
        
        return view('admin.dashboards.index', compact('data1','data2', 'latestSensorData'));
    }
}
