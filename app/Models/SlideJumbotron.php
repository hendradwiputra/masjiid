<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SlideJumbotron extends Model
{
    protected $fillable = ['image_id', 'status_id', 'title', 'content', 'start_date', 'end_date'];

    protected $table = 'slide_jumbotron';

    /**
     * Get the image associated with the slide jumbotron.
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
