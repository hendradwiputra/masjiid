<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prayertimes extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'timezone',
        'dst',
        'prayer_names',
        'prayer_correction',
        'time_format',
        'calculation_method',        
        'hijri_adjustment',
        'adhan_title',
        'adhan_duration',
        'iqomah_title',
        'iqomah_duration',
        'prayers_title',
        'prayers_duration',
        'jumuah_duration',
        'sunrise_title',
        'sunrise_duration',
        'created_by',
        'updated_by',
    ];

    protected $table = 'prayertimes';

    protected $primaryKey = 'id';

    protected $casts = [
        'prayer_names' => 'array',
        'prayer_correction' => 'array',
    ];

    // Relationships
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
