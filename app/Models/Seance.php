<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seance extends Model
{
    use HasFactory;

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function salle(): BelongsTo
    {
        return $this->belongsTo(Salle::class);
    }
}
