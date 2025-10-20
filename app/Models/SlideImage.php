<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class SlideImage extends Model
{
    protected $fillable = ['image_id', 'fullscreen_mode', 'status_id', 'title', 'content', 'author',
                    'start_date', 'end_date'];

    protected $table = 'slide_images';

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Get the image associated with the slide image.
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
