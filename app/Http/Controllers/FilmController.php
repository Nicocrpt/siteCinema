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
use App\Services\TmdbService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Support\Str;

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


    public function addMovieToDb($id): void
    {
        $tmdbClient = new TmdbService;

        $movie = $tmdbClient->getFilmById($id);


        DB::table('films')->insert([
            'tmdb_id' => $movie['id'],
            'slug' => Str::slug($movie['title']),
            'titre' => $movie['title'],
            'synopsis' => $movie['overview'],
            'url_affiche' => 'https://image.tmdb.org/t/p/original' . $movie['poster_path'],
            'duree' => $movie['runtime'],
            
        ]);

        $countries = Pays::whereIn('alpha_2', $movie['origin_country'])->get();

        foreach ($countries as $country) {
            DB::table('film_pays')->insert([
                'film_id' => Film::where('tmdb_id', $movie['id'])->first()->id,
                'pays_id' => $country->id
            ]);
        }

        foreach ($movie['genres'] as $genre) {

            if (!Genre::where('tmdb_id', $genre['id'])->exists()) {
                Genre::create([
                    'tmdb_id' => $genre['id'],
                    'nom' => $genre['name'],
                ]);
            }
            DB::table('film_genre')->insert([
                'film_id' => Film::where('tmdb_id', $movie['id'])->first()->id,
                'genre_id' => Genre::where('tmdb_id', $genre['id'])->first()->id
            ]);
        }

        foreach ($movie['credits']['crew'] as $crew) {
            if ($crew['job'] === "Director") {
                if (!Realisateur::where('tmdb_id', $crew['id'])->exists()) {
                    Realisateur::create([
                        'tmdb_id' => $crew['id'],
                        'nom' => $crew['name'],
                    ]);
                }

                DB::table('film_realisateur')->insert([
                    'film_id' => Film::where('tmdb_id', $movie['id'])->first()->id,
                    'realisateur_id' => Realisateur::where('tmdb_id', $crew['id'])->first()->id
                ]);
            }
        }

        foreach ($movie['credits']['cast'] as $actor) {
            if ($actor['order'] < 4) {
                if (!Acteur::where('tmdb_id', $actor['id'])->exists()) {
                    Acteur::create([
                        'tmdb_id' => $actor['id'],
                        'nom' => $actor['name'],
                    ]);
                }
                DB::table('film_acteur')->insert([
                    'film_id' => Film::where('tmdb_id', $movie['id'])->first()->id,
                    'acteur_id' => Acteur::where('tmdb_id', $actor['id'])->first()->id
                ]);
            }
        }

        foreach ($movie['credits']['crew'] as $crew) {
            if ($crew['job'] === "Original Music Composer") {
                if (!Compositeur::where('tmdb_id', $crew['id'])->exists()) {
                    Compositeur::create([
                        'tmdb_id' => $crew['id'],
                        'nom' => $crew['name'],
                    ]);
                }
                DB::table('film_compositeur')->insert([
                    'film_id' => Film::where('tmdb_id', $movie['id'])->first()->id,
                    'compositeur_id' => Compositeur::where('tmdb_id', $crew['id'])->first()->id
                ]);
            }
        }


    }

    public function addfilm(Request $request)
    {
        $request->validate([
            'tmdb_id' => 'integer|required',
        ]);

        try {
            // Créer une nouvelle instance du film
            $this->addMovieToDb($request->tmdb_id);

            return response()->json([
                'success' => true,
                'message' => 'Film ajouté avec succès !',
            ], 201);
        } catch (\Exception $e) {
            // Gérer l'erreur
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de l\'ajout à la base de données : ' . $e->getMessage(),
            ], 500);
        }

        
        
    }


}
