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
        // Retrieve the settings data
        $settings = SettingData::first();

        // Ensure settings are available
        if (!$settings) {
            return redirect()->back()->with('error', 'Settings data is missing.');
        }

        // Extract settings values
        $tempMin = $settings->tempMin;
        $tempMax = $settings->tempMax;
        $phMin = $settings->phMin;
        $phMax = $settings->phMax;
        $feedMax = $settings->feedMax;

        $sensors = Sensor::all();

        foreach ($sensors as $sensor) {
            DB::transaction(function () use ($sensor, $tempMin, $tempMax, $phMin, $phMax, $feedMax) {
                $currentTime = Carbon::now('Asia/Jakarta');
                $date = $currentTime->format('Y-m-d');
                $time = $currentTime->format('H:i:s');

                $checkNotificationInterval = function ($category, $interval) use ($currentTime) {
                    $lastNotification = Notification::where('category', $category)
                        ->orderBy('created_at', 'desc')
                        ->first();

                    if ($lastNotification) {
                        $lastNotifiedAt = Carbon::parse($lastNotification->last_notified_at);
                        if ($currentTime->diffInMinutes($lastNotifiedAt) < $interval) {
                            return false;
                        }
                    }

                    return true;
                };

                if ($sensor->suhu > $tempMax && $checkNotificationInterval('Suhu', 3)) {
                    Notification::create([
                        'category' => 'Suhu',
                        'information' => "Suhu kolam lebih dari $tempMax °C segera periksa area kolam dan fan pada kolam!",
                        'time' => $time,
                        'date' => $date,
                        'last_notified_at' => $currentTime,
                    ]);
                }

                if ($sensor->suhu < $tempMin && $checkNotificationInterval('Suhu', 3)) {
                    Notification::create([
                        'category' => 'Suhu',
                        'information' => "Suhu kolam kurang dari $tempMin °C segera periksa area kolam dan heater pada kolam!",
                        'time' => $time,
                        'date' => $date,
                        'last_notified_at' => $currentTime,
                    ]);
                }

                if ($sensor->pakan > $feedMax && $checkNotificationInterval('Pakan', 3)) {
                    Notification::create([
                        'category' => 'Pakan',
                        'information' => "Pakan ikan hampir habis segera isi ulang pakan!",
                        'time' => $time,
                        'date' => $date,
                        'last_notified_at' => $currentTime,
                    ]);
                }

                if ($sensor->ph > $phMax && $checkNotificationInterval('Kadar PH', 3)) {
                    Notification::create([
                        'category' => 'Kadar PH',
                        'information' => "Kadar PH lebih dari $phMax segera cek air pada kolam!",
                        'time' => $time,
                        'date' => $date,
                        'last_notified_at' => $currentTime,
                    ]);
                }

                if ($sensor->ph < $phMin && $checkNotificationInterval('Kadar PH', 3)) {
                    Notification::create([
                        'category' => 'Kadar PH',
                        'information' => "Kadar PH kurang dari $phMin segera cek air pada kolam!",
                        'time' => $time,
                        'date' => $date,
                        'last_notified_at' => $currentTime,
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
}
