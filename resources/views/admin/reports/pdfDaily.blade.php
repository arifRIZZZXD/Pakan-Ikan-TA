<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan Harian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Detail Laporan Harian</h2>
    <table>
        <tr>
            <th>Rata-rata Suhu</th>
            <td>{{ $report->average_temperature }} °C</td>
        </tr>
        <tr>
            <th>Rata-rata PH</th>
            <td>{{ $report->average_ph }}</td>
        </tr>
        <tr>
            <th>Rata-rata SISA Pakan</th>
            <td><span class="badge {{ $report->feedStatusBadge($feedMax) }}">
                {{ $report->feedStatusText($feedMax) }}
            </span></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $report->date->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td><span class="badge {{ $report->statusBadge() }}">{{ $report->status }}</span></td>
        </tr>
    </table>
</body>
</html>