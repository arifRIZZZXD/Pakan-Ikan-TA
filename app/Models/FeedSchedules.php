<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedSchedules extends Model
{
    use HasFactory;
    protected $table = 'feed_schedules';
    protected $fillable = [
        'jam1', 'menit1', 'jam2', 'menit2', 'jam3', 'menit3'
    ];
}
