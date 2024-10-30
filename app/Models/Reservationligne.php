<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservationligne extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'place_id',
        'prix',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
