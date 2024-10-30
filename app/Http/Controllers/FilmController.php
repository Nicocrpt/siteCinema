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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FilmController extends Controller
{

    public function welcomePage(): View
    {
        $films = Film::with('seances')->with('realisateurs')->get();
        $seances = Seance::with('film')->get();

        return view('index', compact('films', 'seances'));
    }

    public function userQuery(Request $request)
    {   
        

        $title = urldecode($request->query('research'));

    // Si le paramètre n'est pas fourni, renvoie une erreur
        if (empty($title)) {
            return response()->json(['error' => 'Aucun terme de recherche fourni.'], 400);
        }

        // Effectue la requête pour récupérer les films correspondant au slug
        try {
            $films = Film::where('titre', 'like', '%' . $title . '%')->with('realisateurs')->get();

            // Si aucun film n'est trouvé, renvoie un message approprié
            if ($films->isEmpty()) {
                return response()->json(['message' => 'Aucun film trouvé.'], 404);
            }

            // Retourne les films trouvés en format JSON
            return response()->json($films);
        } catch (\Exception $e) {
            // En cas d'erreur, logue l'erreur et renvoie une erreur 500
            return response()->json(['error' => 'Erreur interne du serveur.'], 500);
        }
    }

    public function index(): View
    {
        $films = Film::all();
        $genres = Genre::all();

        return view('films.indexV2', compact('films', 'genres'));
    }

    public function show($slug): View
    {
        $film = Film::where('slug', $slug)->first();
        $duration = $film->formatDuration();

        $datesSeances = [];
        setlocale(LC_TIME, 'fr_FR.UTF-8');
        foreach ($film->seances as $Seance) {
            if(!in_array(strftime('%A %d %B', strtotime($Seance->datetime_seance)), $datesSeances)) {
                $datesSeances[] = strftime('%A %d %B', strtotime($Seance->datetime_seance));
            }
        }

        return view('films.showV2', compact('film', 'duration', 'datesSeances'));
    }



}
