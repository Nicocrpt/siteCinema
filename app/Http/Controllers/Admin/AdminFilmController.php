<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acteur;
use App\Models\Compositeur;
use App\Models\Film;
use App\Models\Realisateur;
use App\Models\Seance;
use App\Services\TmdbService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
        try {
            $film = Film::find($id);

            $backdrop = str_replace('https://image.tmdb.org/t/p/original', '', $film->url_backdrop);
            $poster = str_replace('https://image.tmdb.org/t/p/original', '', $film->url_affiche);
            $logo = str_replace('https://image.tmdb.org/t/p/original', '', $film->url_logo);


            $tmdbClient = new TmdbService;
            $movie = $tmdbClient->getAllFilmById($film->tmdb_id);

            $tmdb_backdrops = collect($movie['images']['backdrops']);
            $index = $tmdb_backdrops->search(fn($item) => $item['file_path'] === $backdrop);
            $selectedBackdrop = $tmdb_backdrops->pull($index);
            $tmdb_backdrops->prepend($selectedBackdrop);
            $tmdb_backdrops = $tmdb_backdrops->pluck('file_path');


            $tmdb_posters = collect($movie['images']['posters']);
            $index = $tmdb_posters->search(fn($item) => $item['file_path'] === $poster);
            $selectedPoster = $tmdb_posters->pull($index);
            $tmdb_posters->prepend($selectedPoster);


            $tmdb_logos = collect($movie['images']['logos']);
            $index = $tmdb_logos->search(fn($item) => $item['file_path'] === $logo);
            $selectedLogo = $tmdb_logos->pull($index);
            $tmdb_logos->prepend($selectedLogo);
            $tmdb_logos = $tmdb_logos->pluck('file_path');


            $booked = false;
            foreach(Seance::where('film_id', $film->id)->get() as $seance) {
                if($seance->reservations->count() != 0) {
                $booked = true;
                }
            }

            return view('admin.films.edit', compact('film', 'booked', 'tmdb_backdrops', 'tmdb_posters', 'tmdb_logos'));
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la modification : ' . $e->getMessage(),
            ], 500);
        }     
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {

            $request->validate([
                'titre' => ['required', 'string', 'max:255'],
                'acteurs' => ['required', 'string'],
                'realisateurs' => ['required', 'string'],
                'compositeurs' => ['required', 'string'],
                'synopsis' => ['required', 'string'],
                'backdrop_path' => ['required', 'string'],
                'logo_path' => ['required', 'string'],
                'poster_path' => ['required', 'string'],
                'trailer_path' => ['required', 'string'],
                'is_favorite' => ['required', 'boolean'],
                'certification' => ['required'],
                'images_string' => ['required', 'string'],
            ]);

            switch ($request->certification) {
                case 'Touts publics':
                    $certification = 3;
                    break;
                case '12':
                    $certification = 1;
                    break;
                case '16':
                    $certification = 2;
                    break;
                case '18':
                    $certification = 4;
                    break;

            }

            $film = Film::find($id);
            $film->update([
                'titre' => $request->titre,
                'synopsis' => $request->synopsis,
                'certification_id' => $certification,
                'images' => $request->images_string,
                'est_favori' => $request->is_favorite,
                'url_backdrop' => $request->backdrop_path,
                'url_affiche' => $request->poster_path,
                'url_logo' => $request->logo_path,
            ]);

            // foreach(explode(',', $request->acteurs) as $actor) {
            //     if (!Acteur::where('nom', $actor)->exists()) {
            //         Acteur::create([
            //             'nom' => $actor,
            //         ]);

            //     }

            //     if (!DB::table('film_acteur')->where('film_id', $film->id)->where('acteur_id', Acteur::where('nom', $actor)->first()->id)->exists()) {
            //         $order = DB::table('film_acteur')->where('film_id', $film->id)->count() + 1;
            //         DB::table('film_acteur')->insert([
            //             'film_id' => $film->id,
            //             'acteur_id' => Acteur::where('nom', $actor)->first()->id,
            //             'ordre' => $order
            //         ]);
            //     }
            // }

            // foreach(explode(',', $request->compositeurs) as $composer) {
            //     if (!Compositeur::where('nom', $composer)->exists()) {
            //         Compositeur::create([
            //             'nom' => $composer,
            //         ]);
            //     }

            //     if (!DB::table('film_compositeur')->where('film_id', $film->id)->where('compositeur_id', Compositeur::where('nom', $composer)->first()->id)->exists()) {
            //         DB::table('film_compositeur')->insert([
            //             'film_id' => $film->id,
            //             'compositeur_id' => Compositeur::where('nom', $composer)->first()->id,
            //         ]);
            //     }
            // }

            // foreach(explode(',', $request->realisateurs) as $director) {
            //     if (!Realisateur::where('nom', $director)->exists()) {
            //         Realisateur::create([
            //             'nom' => $director,
            //         ]);
            //     }

            //     if (!DB::table('film_realisateur')->where('film_id', $film->id)->where('realisateur_id', Compositeur::where('nom', $director)->first()->id)->exists()) {
            //         DB::table('film_realisateur')->insert([
            //             'film_id' => $film->id,
            //             'realisateur_id' => Compositeur::where('nom', $director)->first()->id,
            //         ]);
            //     }
            // }

            return response()->json([
                'success' => true,
                'message' => 'Film mis à jour avec succès !',
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la modification : ' . $e->getMessage(),
            ], 500);
        }
    }


    public function searchFilms(Request $request): JsonResponse
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

    public function updateFavorite(Request $request): JsonResponse {
        try {
            $request->validate([
                'favoriteState' => 'required',
                'id' => 'required'
            ]);
            $film = Film::find($request->id);
            $film->est_favori = $request->favoriteState;
            $film->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la recherche : ' . $e->getMessage(),
            ], 500);
        }

    }

    public function getPerson(Request $request): JsonResponse {
        try {
            $request->validate([
                'query' => 'required'
            ]);
            $tmdbClient = new TmdbService;
            $person = $tmdbClient->getPerson($request->get('query')) ?? null;
            if (!$person) {
                return response()->json(['success' => false, 'message' => 'Aucune personne trouvée']); 
            }
            return response()->json($person);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la recherche : ' . $e->getMessage(),
            ], 500);
        }
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
                'certification' => 'required',
                'publish' => ['required', 'integer'],
            ]);

    
            $tmdbClient = new TmdbService;

            $movie = $tmdbClient->getAllFilmById($request->tmdb_id);

            $movie['backdrop_path'] = $request->backdrop_path;
            $movie['logo_path'] = $request->logo_path;
            $movie['poster_path'] = $request->poster_path;
            $movie['trailer'] = $request->trailer;
            $movie['images'] = $request->images_string;
            $movie['isFavorite'] = $request->isFavorite;
            $movie['certification'] = $request->certification;
            $movie['publish'] = $request->publish;
    
            $tmdbClient->addCustomMovieToDb($movie);

            return redirect()->route('admin.films.manage')->with('success', "Film ajouté avec succès !");
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de l\'ajout à la base de données : ' . $e->getMessage(),
            ], 500);

        }
        

        
    }

    public function destroy(Request $request):RedirectResponse {
        Film::where('id', $request->idFilm)->delete();
        return redirect()->route('admin.films.manage')->with('success', "Film supprimé avec succès !");
    }
}
