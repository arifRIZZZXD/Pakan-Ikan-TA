<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;

class SensorController extends Controller
{
    public function readtemp(){
        // Baca nilai / Isi table sensor dan ambil data temp
        $sensors = Sensor::select('*')->get();
        // kirim ke tampilan baca temp
        return view('readSensor.readtemp',['nilaiSensor' => $sensors]);
    }

    public function readPh(){
        // Baca nilai / Isi table sensor dan ambil data temp
        $sensors = Sensor::select('*')->get();
        // kirim ke tampilan baca temp
        return view('readSensor.readPh',['nilaiSensor' => $sensors]);
    }

    public function readfeed(){
        // Baca nilai / Isi table sensor dan ambil data temp
        $sensors = Sensor::select('*')->get();
        // kirim ke tampilan baca temp
        return view('readSensor.readfeed',['nilaiSensor' => $sensors]);
    }
}
