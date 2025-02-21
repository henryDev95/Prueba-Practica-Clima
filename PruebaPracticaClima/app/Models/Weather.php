<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Weather extends Model
{
    use HasFactory;

    protected $table = 'weather';

    protected $fillable = [
        'location_id',
        'temperature',
        'humidity',
        'pressure',
        'description',
        'icon',
        'recorded_at',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
