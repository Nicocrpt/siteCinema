<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;

    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'film_genre');
    }

    public function pays(): BelongsToMany
    {
        return $this->belongsToMany(Pays::class, 'film_pays');
    }

    public function formatDuration()
    {
        if ($this->duree > 60) {
            $hours = floor($this->duree / 60);
            $minutes =($this->duree % 60);
            if ($minutes < 10) {
                return $hours . 'h0' . $minutes;
            }else{
                return $hours . 'h' . $minutes;
            }
        }else{
            if ($this->duree < 10) {
                return '0' . $this->duree . 'mn';
            }else{
                return $this->duree . 'mn';
            }
            
        }
    }
}
