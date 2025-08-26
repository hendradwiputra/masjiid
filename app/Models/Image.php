<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['category', 'image_name'];

    protected $table = 'images'; 

    //public $timestamps = false;

}
