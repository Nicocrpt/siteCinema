<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pays extends Model
{
    protected $table = 'payss';

    use HasFactory;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'film_pays');
    }
}
