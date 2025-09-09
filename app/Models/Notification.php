<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'sunrise_caption', 'prayer_caption',
        'jumuah_caption','before_adhan_caption', 
        'adhan_caption', 'iqomah_caption', 
    ];

    protected $table = 'notifications';
}
