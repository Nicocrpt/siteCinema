<?php

namespace App\Livewire;

use App\Models\Film;
use Livewire\Component;

class FilmMakeFavourite extends Component
{

    public function updateFilm($id)
    {
        Film::where('id', $this->filmId)->update(['est_favori' => $this->favoriteValue]);
    }
    public function render()
    {
        return view('livewire.film-make-favourite');
    }
}
