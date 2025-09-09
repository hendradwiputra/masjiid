<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Praytime extends Model
{
    protected $fillable = [
        'time_format', 'prayer_calc_method', 'latitude', 'longitude', 'dst', 'timezone', 'dst', 'hijri_correction',
        'prayer1_alias', 'prayer2_alias', 'prayer3_alias', 'prayer4_alias', 'prayer5_alias', 'prayer6_alias',
        'sunrise_lock_duration', 'prayer_lock_duration', 'jumuah_lock_duration', 'adhan_duration', 
        'prayer1_iqomah_duration', 'prayer3_iqomah_duration',
        'prayer4_iqomah_duration', 'prayer5_iqomah_duration', 'prayer6_iqomah_duration',
        'prayer1_correction', 'prayer2_correction', 'prayer3_correction',
        'prayer4_correction', 'prayer5_correction', 'prayer6_correction'
    ];

    protected $table = 'praytimes';

    protected static function booted()
    {
        static::saved(function ($praytime) {
            Cache::forget('praytimes');
            \Log::info("Praytimes cache cleared for ID {$praytime->id}");
        });
    }
}
