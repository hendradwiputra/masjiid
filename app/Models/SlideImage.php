<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class SlideImage extends Model
{
    protected $fillable = ['image_id', 'status_id'];

    protected $table = 'slide_images';

    /**
     * Get the image associated with the slide image.
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
