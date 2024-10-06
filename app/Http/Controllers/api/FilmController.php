<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Acteur;
use App\Models\Compositeur;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Langue;
use App\Models\Pays;
use App\Models\Production;
use App\Models\Realisateur;
use App\Services\TmdbService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        try {
            $films = Film::query();

            if ($request->query('acteurs')==='1') {
                $films->with('acteurs:id,nom,tmdb_id');
            }
            if ($request->query('realisateurs')==='1') {
                $films->with('realisateurs:id,nom,tmdb_id');
            }
            if ($request->query('pays')==='1') {
                $films->with('pays:id,nom,alpha_2');
            }
            if ($request->query('genres')==='1') {
                $films->with('genres:id,nom,tmdb_id');
            }
            if ($request->query('compositeurs')==='1') {
                $films->with('compositeurs:id,nom,tmdb_id');
            }
            if ($request->query('langue')==='1') {
                $films->with('langue:id,langue,iso_2');
            }

            $films = $films->get();

            return response()->json($films);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la sélection des films : ' . $e->getMessage(),
            ]);
        }
        


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        try {
            $film = Film::query();

            if ($request->query('pays')==='1') {
                $film->with('pays:id,nom,alpha_2');
            }
            if ($request->query('acteurs')==='1') {
                $film->with('acteurs:id,nom,tmdb_id');
            }
            if ($request->query('realisateurs')==='1') {
                $film->with('realisateurs:id,nom,tmdb_id');
            }
            if ($request->query('genres')==='1') {
                $film->with('genres:id,nom,tmdb_id');
            }
            if ($request->query('compositeurs')==='1') {
                $film->with('compositeurs:id,nom,tmdb_id');
            }
            if ($request->query('langue')==='1') {
                $film->with('langue:id,langue,iso_2');
            }

            $film = $film->find($id)->get();

            return response()->json($film);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la récupération du film : ' . $e->getMessage(),
            ],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Film::destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Film supprimé avec succès !',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la suppression : ' . $e->getMessage(),
            ],500);
        }
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
            'langue_id' => Langue::where('iso_2', $movie['original_language'])->first()->id,
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
                    'acteur_id' => Acteur::where('tmdb_id', $actor['id'])->first()->id,
                    'ordre' => $actor['order']
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

        foreach ($movie['production_companies'] as $prod) {

            if (!Production::where('tmdb_id', $prod['id'])->exists()) {
                Production::create([
                    'tmdb_id' => $prod['id'],
                    'nom' => $prod['name'],
                    'pays_id' => Pays::where('alpha_2', $prod['origin_country'])->first()->id
                ]);
            }

            DB::table('film_production')->insert([
                'film_id' => Film::where('tmdb_id', $movie['id'])->first()->id,
                'production_id' => Production::where('tmdb_id', $prod['id'])->first()->id
            ]);

        }


    }
}
