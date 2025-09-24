<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['category', 'image_name', 'start_date', 'end_date'];

    protected $table = 'images'; 

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

}
