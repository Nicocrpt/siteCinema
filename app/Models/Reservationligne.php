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
        'seance_id',
        'place_id',
        'prix',
        'is_active'
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function seance(): BelongsTo
    {
        return $this->belongsTo(Seance::class);
    }
}
