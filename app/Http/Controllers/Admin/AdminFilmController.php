<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Services\TmdbService;
use Illuminate\Http\Request;

class AdminFilmController extends Controller
{
    public function index()
    {
        return view('admin.index');
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

    public function create($id)
    {

        $tmdbClient = new TmdbService;
        $movie = $tmdbClient->getAllFilmById($id);

        return view('admin.createFilm', compact('movie'));
    }
}
