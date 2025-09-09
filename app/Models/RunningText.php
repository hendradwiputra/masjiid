<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class RunningText extends Model
{
    protected $fillable = [
        'announcement', 'start_date', 'end_date'
    ];

    protected $table = 'running_text';

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected static function booted()
    {
        static::saved(function ($runningText) {
            Cache::forget('ticker_text');
            \Log::info("Ticker text cache cleared for RunningText ID {$runningText->id}");
        });
    }
}