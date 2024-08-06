<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sensor;
use App\Models\SettingData;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationsController extends Controller
{
    public function index()
    {
        $settings = SettingData::first();

        if (!$settings) {
            return redirect()->back()->with('error', 'Settings data is missing.');
        }

        $tempMin = $settings->tempMin;
        $tempMax = $settings->tempMax;
        $phMin = $settings->phMin;
        $phMax = $settings->phMax;
        $feedMax = $settings->feedMax;

        $latestSensor = Sensor::latest()->first();

        if ($latestSensor) {
            DB::transaction(function () use ($latestSensor, $tempMin, $tempMax, $phMin, $phMax, $feedMax) {
                $currentTime = Carbon::now('Asia/Jakarta');
                $date = $currentTime->format('Y-m-d');
                $time = $currentTime->format('H:i:s');

                // Mengambil notifikasi terbaru berdasarkan kategori
                $lastTempNotification = Notification::where('category', 'temp')->latest()->first();
                $lastFeedNotification = Notification::where('category', 'feed')->latest()->first();
                $lastPhNotification = Notification::where('category', 'Kadar PH')->latest()->first();

                // temp
                if ($latestSensor->temp > $tempMax &&
                    (!$lastTempNotification || 
                    $latestSensor->temp !== $lastTempNotification->lastValueTemp || 
                    ($lastTempNotification && $lastTempNotification->lastValueTemp == $latestSensor->temp && Carbon::parse($lastTempNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {
                    Notification::create([
                        'category' => 'Suhu',
                        'information' => "Suhu kolam lebih dari $tempMax °C segera periksa area kolam dan fan pada kolam!",
                        'time' => $time,
                        'date' => $date,
                        'lastValueTemp' => $latestSensor->temp,
                        'lastNotified_at' => $currentTime,
                    ]);
                } elseif ($latestSensor->temp < $tempMin &&
                    (!$lastTempNotification || 
                    $latestSensor->temp !== $lastTempNotification->lastValueTemp || 
                    ($lastTempNotification && $lastTempNotification->lastValueTemp == $latestSensor->temp && Carbon::parse($lastTempNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {
                    Notification::create([
                        'category' => 'Suhu',
                        'information' => "Suhu kolam kurang dari $tempMin °C segera periksa area kolam dan heater pada kolam!",
                        'time' => $time,
                        'date' => $date,
                        'lastValueTemp' => $latestSensor->temp,
                        'lastNotified_at' => $currentTime,
                    ]);
                }

                // feed
                if ($latestSensor->feed > $feedMax &&
                    (!$lastFeedNotification || 
                    $latestSensor->feed !== $lastFeedNotification->lastValueFeed || 
                    ($lastFeedNotification && $lastFeedNotification->lastValueFeed == $latestSensor->feed && Carbon::parse($lastFeedNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {
                    Notification::create([
                        'category' => 'Pakan',
                        'information' => "Pakan ikan hampir habis segera isi ulang tabung Pakan!",
                        'time' => $time,
                        'date' => $date,
                        'lastValueFeed' => $latestSensor->feed,
                        'lastNotified_at' => $currentTime,
                    ]);
                }

                // Kadar PH
                if ($latestSensor->ph > $phMax &&
                    (!$lastPhNotification || 
                    $latestSensor->ph !== $lastPhNotification->lastValuePh || 
                    ($lastPhNotification && $lastPhNotification->lastValuePh == $latestSensor->ph && Carbon::parse($lastPhNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {
                    Notification::create([
                        'category' => 'Kadar PH',
                        'information' => "Kadar PH lebih dari $phMax segera cek air pada kolam!",
                        'time' => $time,
                        'date' => $date,
                        'lastValuePh' => $latestSensor->ph,
                        'lastNotified_at' => $currentTime,
                    ]);
                } elseif ($latestSensor->ph < $phMin &&
                    (!$lastPhNotification || 
                    $latestSensor->ph !== $lastPhNotification->lastValuePh || 
                    ($lastPhNotification && $lastPhNotification->lastValuePh == $latestSensor->ph && Carbon::parse($lastPhNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {
                    Notification::create([
                        'category' => 'Kadar PH',
                        'information' => "Kadar PH kurang dari $phMin segera cek air pada kolam!",
                        'time' => $time,
                        'date' => $date,
                        'lastValuePh' => $latestSensor->ph,
                        'lastNotified_at' => $currentTime,
                    ]);
                }
            });
        }

        $notifications = Notification::orderBy('created_at', 'desc')->take(100)->get();

        return view('admin.notification.index', compact('notifications'));
    }

    public function getLatestNotifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->take(100)->get();
        return response()->json($notifications);
    }

    public function destroy($id)
    {
        // Cari notifikasi berdasarkan ID
        $notification = Notification::find($id);

        // Jika notifikasi ditemukan, hapus dari database
        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true, 'message' => 'Notifikasi berhasil dihapus.']);
        }

        // Jika tidak ditemukan, kembalikan respons error
        return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan.'], 404);
    }

}
