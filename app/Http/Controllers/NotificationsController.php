<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\SettingData;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        return view('admin.notification.index');
    }

    public function getData()
    {
        // Ambil data pengaturan dari tabel setting_datas
        $settings = SettingData::first();

        $tempMin = $settings->tempMin;
        $tempMax = $settings->tempMax;
        $phMin = $settings->phMin;
        $phMax = $settings->phMax;
        $feedMin = $settings->feedMin;

        // Ambil data dari tabel sensor dan urutkan berdasarkan created_at dari yang terbaru
        $sensors = Sensor::orderBy('created_at', 'desc')->get();

        // Mengolah data untuk notifikasi
        $notifications = [];

        foreach ($sensors as $sensor) {
            if ($sensor->suhu > $tempMax) {
                $notifications[] = [
                    'id' => $sensor->id, // Tambahkan ID untuk penghapusan
                    'category' => 'Suhu',
                    'keterangan' => 'Suhu kolam lebih dari ' . $tempMax . ' °C segera periksa area kolam dan fan pada kolam!',
                    'jam' => $sensor->created_at->format('H:i:s'),
                    'tanggal' => $sensor->created_at->format('Y/m/d'),
                ];
            } elseif ($sensor->suhu < $tempMin) {
                $notifications[] = [
                    'id' => $sensor->id, // Tambahkan ID untuk penghapusan
                    'category' => 'Suhu',
                    'keterangan' => 'Suhu kolam kurang dari ' . $tempMin . ' °C segera periksa area kolam dan heater pada kolam!',
                    'jam' => $sensor->created_at->format('H:i:s'),
                    'tanggal' => $sensor->created_at->format('Y/m/d'),
                ];
            }

            if ($sensor->pakan <= $feedMin) {
                $notifications[] = [
                    'id' => $sensor->id, // Tambahkan ID untuk penghapusan
                    'category' => 'Pakan',
                    'keterangan' => 'Pakan ikan hampir habis segera isi ulang pakan!',
                    'jam' => $sensor->created_at->format('H:i:s'),
                    'tanggal' => $sensor->created_at->format('Y/m/d'),
                ];
            }

            if ($sensor->ph > $phMax) {
                $notifications[] = [
                    'id' => $sensor->id, // Tambahkan ID untuk penghapusan
                    'category' => 'Kadar PH',
                    'keterangan' => 'Kadar PH lebih dari ' . $phMax . ' segera cek air pada kolam!',
                    'jam' => $sensor->created_at->format('H:i:s'),
                    'tanggal' => $sensor->created_at->format('Y/m/d'),
                ];
            } elseif ($sensor->ph < $phMin) {
                $notifications[] = [
                    'id' => $sensor->id, // Tambahkan ID untuk penghapusan
                    'category' => 'Kadar PH',
                    'keterangan' => 'Kadar PH kurang dari ' . $phMin . ' segera cek air pada kolam!',
                    'jam' => $sensor->created_at->format('H:i:s'),
                    'tanggal' => $sensor->created_at->format('Y/m/d'),
                ];
            }
        }

        return response()->json($notifications);
    }

    public function destroy($id)
    {
        $sensor = Sensor::find($id);
        if ($sensor) {
            $sensor->delete();
            return response()->json(['success' => 'Notifikasi berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Notifikasi tidak ditemukan'], 404);
        }
    }
}
