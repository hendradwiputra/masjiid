<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = ['ticker_direction', 'ticker_speed'];

    protected $table = 'app_settings';
}
