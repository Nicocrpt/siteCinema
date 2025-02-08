<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = [
        'film_id',
        'url_image'
    ];
    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }
}
