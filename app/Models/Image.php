<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Image extends Model        
{
    protected $fillable = ['file_name', 'type', 'mime_type', 'file_size'];

    protected $table = 'images';                                

    /**
     * Get the slide images that use this image.
     */
    public function slideImages(): HasMany
    {
        return $this->hasMany(SlideImage::class, 'image_id');
    }

    /**
     * Get the profile that uses this image.
     */
    public function profile():HasOne
    {
        return $this->hasOne(Profile::class, 'image_id');
    }

    // Helper methods
    public function isImage(): bool
    {
        return $this->type === 'image';
    }

    public function isVideo(): bool
    {
        return $this->type === 'video';
    }

}
