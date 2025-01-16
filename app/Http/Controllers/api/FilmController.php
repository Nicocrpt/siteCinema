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


    public function send(Request $request)
    {
        $request->validate([
            'id' => 'integer|required',
        ]);
        
        $tmdbClient = new TmdbService;
        $movie = $tmdbClient->getAllFilmById($request->id);

        return response()->json($movie);
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
            $tmdbClient = new TmdbService;
            $tmdbClient->addMovieToDb($request->tmdb_id);

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


    public function adminAdd(Request $request)
    {
        try {
            $request->validate([
                'poster_path' => 'string|required',
                'backdrop_path' => 'string|required',
                'logo_path' => 'string|required',
            ]);

            $movie = $request->json()->all();

            try {
                // Créer une nouvelle instance du film
                $tmdbClient = new TmdbService;
                $tmdbClient->addCustomMovieToDb($movie);

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
        } catch (\Exception $e) {
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

            $film = $film->findOrFail($id);

            return response()->json($film);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la récupération du film : ' . $e->getMessage(),
            ],500);
        }
    }

    public function getFilm($id)
    {
        $client = new TmdbService;
        return response()->json($client->getAllFilmById($id));
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
}
