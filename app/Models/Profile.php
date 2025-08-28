<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'logo',
        'image_id',
        'name',
        'address',
        'description',
        'contact_no',
        'selected_theme'
    ];

    protected $table = 'profiles';

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
