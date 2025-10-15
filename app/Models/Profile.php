<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Profile extends Model
{
    protected $fillable = [
        'image_id',
        'name',
        'address',
        'description',
        'contact_no',
        'selected_theme'
    ];

    protected $table = 'profiles';

    protected static function booted()
    {
        static::saved(function ($profile) {
            Cache::forget('profile');
            \Log::info("Caches cleared for Profile ID {$profile->id}");
        });
    }

    /**
     * Get the image associated with the profile.
     */
    public function image():BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
