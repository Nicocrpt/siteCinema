<?php

namespace App\Http\Controllers;



use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Acteur;
use App\Models\Compositeur;
use App\Models\Film;
use App\Models\Filmgenre;
use App\Models\Genre;
use App\Models\Pays;
use App\Models\Realisateur;
use App\Models\Reservation;
use App\Models\Seance;
use App\Services\TmdbService;
use Carbon\Carbon;
use Exception;
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


        if (empty($title)) {
            return response()->json(['error' => 'Aucun terme de recherche fourni.'], 400);
        }

        
        try {
            $films = [];

            $moviesRequest = Film::where('titre', 'like', '%' . $title . '%')->with('realisateurs')->with('acteurs')->get();
            if (!$moviesRequest->isEmpty()) {
                foreach ($moviesRequest as $movie) {
                    $check = false;
                    if ($films) {
                        foreach ($films as $film) {
                            $check = $film->id == $movie->id ? true : false;
                        }
                    }
                    if (!$check) {
                        $films[] = $movie;
                    }     
                }
            }

            $actorsRequest = Acteur::where('nom', 'like', '%' . $title . '%')->with('films')->get();
            if (!$actorsRequest->isEmpty()) {
                foreach ($actorsRequest as $actor) {
                    foreach ($actor->films as $movie) {
                        $movie = Film::where('id', $movie->id)->with('realisateurs')->with('acteurs')->first();
                        $check = false;
                        if ($films) {
                            foreach ($films as $film) {
                                $check = $film->id == $movie->id ? true : false;
                            }
                        }
                        if (!$check) {
                            $films[] = $movie;
                        }     
                    }
                }
            }

            $realisateursRequest = Realisateur::where('nom', 'like', '%' . $title . '%')->with('films')->get();
            if (!$realisateursRequest->isEmpty()) {
                foreach ($realisateursRequest as $realisateur) {
                    foreach ($realisateur->films as $movie) {
                        $movie = Film::where('id', $movie->id)->with('realisateurs')->with('acteurs')->first();
                        $check = false;
                        if ($films) {
                            foreach ($films as $film) {
                                $check = $film->id == $movie->id ? true : false;
                            }
                        }
                        if (!$check) {
                            $films[] = $movie;
                        }     
                        
                    }
                }
            }

            // Si aucun film n'est trouvé, renvoie un message approprié
            if (!$films) {
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

        return view('films.index', compact('films', 'genres'));
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

    public function getFilms(Request $request)
    {
        try {
            $name = $request->query('name') ?? '';
            $filmsIdsWithGenre = [];
            if ($request->query('genre')) {
                $genre = Genre::where('nom', $request->query('genre'))->first();
                $filmsIdsWithGenre = array_unique(Filmgenre::where('genre_id', $genre->id)->pluck('film_id')->toArray());
            }


            $filmsAvailable = array_unique(Seance::whereRaw('DATE(datetime_seance) >= ?', [Carbon::today()->toDateString()])->pluck('film_id')->toArray());


            $filmsIds = $filmsIdsWithGenre ? array_intersect($filmsAvailable, $filmsIdsWithGenre) : $filmsAvailable ;

            $forthcomingFilmsIds = $filmsIdsWithGenre ? array_diff($filmsIdsWithGenre, $filmsAvailable) : [];

            $availableFilms = $request->query('genre') == null ? Film::whereIn('statut_id', [1])->where('titre', 'like', '%'.$name.'%')->whereIn('id', $filmsIds)->with('realisateurs')->with('acteurs')->with('genres')->get() : Film::whereIn('statut_id', [1])->whereIn('id', $filmsIds)->where('titre', 'like', '%'.$name.'%')->with('realisateurs')->with('acteurs')->with('genres')->get();


            $forthcomingFilms = $request->query('genre') == null ? Film::whereIn('statut_id', [3])->where('titre', 'like', '%'.$name.'%')->with('realisateurs')->with('acteurs')->with('genres')->get() : Film::whereIn('statut_id', [3])->whereIn('id', $filmsIdsWithGenre)->where('titre', 'like', '%'.$name.'%')->with('realisateurs')->with('acteurs')->with('genres')->get();

            return response()->json([
                'availableFilms' => $availableFilms, 
                'forthcomingFilms' => $forthcomingFilms
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
