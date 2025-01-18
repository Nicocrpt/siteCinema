<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Services\TmdbService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View as FacadesView;

class AdminFilmController extends Controller
{

    public function searchPage(): View
    {
        $films_ids = Film::all()->pluck('tmdb_id');
        return view('admin.films.search', compact('films_ids'));
    }

    public function manage(): View
    {
        $films = Film::all();
        return view('admin.films.manage', compact('films'));
    }

    public function edit($id): View
    {
        $film = Film::find($id);
        return view('admin.films.edit', compact('film'));
    }


    public function searchFilms(Request $request)
    {
        try {
            $query = urldecode($request->query('query'));
            
            $client = new TmdbService;
            $clientResponse = $client->queryFilms($query);
            $films =[];

            foreach ($clientResponse as $film) {
                $filteredInfos = [
                    'id' => $film['id'],
                    'title' => $film['title'],
                    'release_date' => date('d/m/Y', strtotime($film['release_date'])),
                    'poster_path' => $film['poster_path'],
                ];

                $films[] = $filteredInfos;
            }

            return response()->json($films);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la recherche : ' . $e->getMessage(),
            ], 500);
        }
        

        
    }

    public function create($id): View
    {

        $tmdbClient = new TmdbService;
        $movie = $tmdbClient->getAllFilmById($id);

        return view('admin.films.create', compact('movie'));
    }

    public function store(Request $request){

        //dd($request);

        try {
            $request->validate([
                'tmdb_id' => 'required',
                'title' => 'required',
                'synopsis' => 'required',
                'images_string' => 'required',
                'backdrop_path' => 'required',
                'logo_path' => 'required',
                'poster_path' => 'required',
                'trailer' => 'required',
                'isFavorite' => 'required',
            ]);
    
            $tmdbClient = new TmdbService;

            $movie = $tmdbClient->getAllFilmById($request->tmdb_id);

            $movie['backdrop_path'] = $request->backdrop_path;
            $movie['logo_path'] = $request->logo_path;
            $movie['poster_path'] = $request->poster_path;
            $movie['trailer'] = $request->trailer;
            $movie['images'] = $request->images_string;
            $movie['isFavorite'] = $request->isFavorite;
    
            $tmdbClient->addCustomMovieToDb($movie);

            return redirect()->route('admin.films.manage');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de l\'ajout à la base de données : ' . $e->getMessage(),
            ], 500);

        }
        

        
    }
}
