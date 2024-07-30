<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // protected $fillable = [
    //     'average_temperature', 'average_ph', 'average_feed', 'status', 'date'
    // ];
    use HasFactory;

    // Pastikan untuk meng-cast kolom 'date' sebagai tanggal
    protected $casts = [
        'date' => 'datetime',
    ];

    // Alternatif jika menggunakan Laravel versi lama:
    // protected $dates = ['date'];

    public function statusBadge()
    {
        return $this->status === 'Safe' ? 'badge-success' :
                ($this->status === 'Warning' ? 'badge-warning' : 'badge-danger');
    }

    public function feedStatusBadge($feedMax)
    {
        return $this->average_feed < $feedMax ? 'badge-success' : 'badge-danger';
    }

    public function feedStatusText($feedMax)
    {
        return $this->average_feed < $feedMax ? 'Pakan Tersedia' : 'Pakan Hampir Habis';
    }
}
