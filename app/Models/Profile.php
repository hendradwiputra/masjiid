<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'logo',
        'name',
        'address',
        'description',
        'contact_no',
        'selected_theme'
    ];

    protected $table = 'profiles';
}
