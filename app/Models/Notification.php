<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category',
        'information',
        'time',
        'date',
        'lastValueTemp',
        'lastValueFeed',
        'lastValuePh',
        'last_notified_at'
    ];
}
