<?php

namespace App\Http\Controllers;



use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Acteur;
use App\Models\Compositeur;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Pays;
use App\Models\Realisateur;
use App\Models\Seance;
use App\Services\TmdbService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Support\Str;

class FilmController extends Controller
{

    public function welcomePage(): View
    {
        $films = Film::with('seances')->with('realisateurs')->get();
        $seances = Seance::with('film')->get();

        return view('index', compact('films', 'seances'));
    }

    public function index(): View
    {
        $films = Film::all();
        
        return view('films.index', compact('films'));
    }

    public function show($slug): View
    {
        $film = Film::where('slug', $slug)->first();
        $duration = $film->formatDuration();

        return view('films.show', compact('film', 'duration'));
    }



}
