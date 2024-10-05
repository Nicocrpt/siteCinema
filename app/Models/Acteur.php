<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Acteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'tmdb_id',
    ];

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'film_acteur');
    }
}
