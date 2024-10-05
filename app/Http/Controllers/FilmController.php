<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class FilmController extends Controller
{
    public function getfilms(): View
    {
        $films = Film::all();
        return view('films.index', compact('films'));
    }

    public function getfilm($slug): View
    {
        $film = Film::where('slug', $slug)->first();
        $duration = $film->formatDuration();

        return view('films.show', compact('film', 'duration'));
    }
}
