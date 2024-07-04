<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;

class SensorController extends Controller
{
    public function readSuhu(){
        // Baca nilai / Isi table sensor dan ambil data suhu
        $sensors = Sensor::select('*')->get();
        // kirim ke tampilan baca suhu
        return view('readSensor.readSuhu',['nilaiSensor' => $sensors]);
    }

    public function readPh(){
        // Baca nilai / Isi table sensor dan ambil data suhu
        $sensors = Sensor::select('*')->get();
        // kirim ke tampilan baca suhu
        return view('readSensor.readPh',['nilaiSensor' => $sensors]);
    }

    public function readPakan(){
        // Baca nilai / Isi table sensor dan ambil data suhu
        $sensors = Sensor::select('*')->get();
        // kirim ke tampilan baca suhu
        return view('readSensor.readPakan',['nilaiSensor' => $sensors]);
    }
}
