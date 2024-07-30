<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Report;
use App\Models\Sensor;
use App\Models\SettingData;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('date', 'desc')->get();
        $feedMax = SettingData::first()->feedMax;
        $weeklyReport = $this->getWeeklyReportData();

        return view('admin.reports.index', compact('reports', 'feedMax', 'weeklyReport'));
    }

    public function dailyReportDetail($id)
    {
        $report = Report::findOrFail($id);
        $feedMax = SettingData::first()->feedMax;
        return view('admin.reports.detailDaily', compact('report','feedMax'));
    }

    public function generateReport()
    {
        $today = Carbon::today('Asia/Jakarta');
        $sensors = Sensor::whereDate('created_at', $today)->get();

        $averageTemperature = $sensors->avg('suhu');
        $averagePh = $sensors->avg('ph');
        $averageFeed = $sensors->avg('pakan');

        $settings = SettingData::first();
        $tempMin = $settings->tempMin;
        $tempMax = $settings->tempMax;
        $phMin = $settings->phMin;
        $phMax = $settings->phMax;
        $feedMax = $settings->feedMax;

        $status = 'Safe';
        $warningCount = 0;

        if ($averageTemperature > $tempMax || $averageTemperature < $tempMin) {
            $warningCount++;
        }

        if ($averagePh > $phMax || $averagePh < $phMin) {
            $warningCount++;
        }

        if ($averageFeed > $feedMax) {
            $warningCount++;
        }

        if ($warningCount >= 2) {
            $status = 'Danger';
        } elseif ($warningCount == 1) {
            $status = 'Warning';
        }

        $report = new Report();
        $report->average_temperature = $averageTemperature;
        $report->average_ph = $averagePh;
        $report->average_feed = $averageFeed;
        $report->status = $status;
        $report->date = $today;
        $report->save();

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dihasilkan');
    }

    public function destroy($id)
    {
        $report = Report::find($id);
        if ($report) {
            $report->delete();
            return redirect()->route('report.index')->with('success', 'Laporan berhasil dihapus');
        }
        return redirect()->route('report.index')->with('error', 'Laporan tidak ditemukan');
    }
    private function getWeeklyReportData()
    {
        $endOfWeek = Carbon::now('Asia/Jakarta');
        $startOfWeek = $endOfWeek->copy()->subDays(7);

        $reports = Report::whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        // Debugging output
        // dd($reports);

        $averageTemperature = $reports->avg('average_temperature');
        $averagePh = $reports->avg('average_ph');
        $averageFeed = $reports->avg('average_feed') ?? 0; // Default to 0 if null

        // Debugging output
        // dd($averageFeed);

        $settings = SettingData::first();
        $tempMin = $settings->tempMin;
        $tempMax = $settings->tempMax;
        $phMin = $settings->phMin;
        $phMax = $settings->phMax;
        $feedMax = $settings->feedMax;

        // Debugging output
        // dd($feedMax);

        $status = 'Safe';
        $warningCount = 0;

        if ($averageTemperature > $tempMax || $averageTemperature < $tempMin) {
            $warningCount++;
        }

        if ($averagePh > $phMax || $averagePh < $phMin) {
            $warningCount++;
        }

        if ($averageFeed > $feedMax) {
            $warningCount++;
        }

        if ($warningCount >= 2) {
            $status = 'Danger';
        } elseif ($warningCount == 1) {
            $status = 'Warning';
        }

        // Debugging output
        // dd($status);

        return [
            'averageTemperature' => $averageTemperature,
            'averagePh' => $averagePh,
            'averageFeed' => $averageFeed,
            'status' => $status,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek
        ];
    }
    
}

