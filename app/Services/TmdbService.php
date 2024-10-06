<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Acteur;
use App\Models\Compositeur;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Pays;
use App\Models\Realisateur;

class TmdbService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        // Crée une instance du client Guzzle
        $this->client = new Client();
        // Remplace par ta clé API TMDB
        $this->apiKey = env('TMDB_API_KEY'); // Assurez-vous que la clé est dans votre .env
    }

    // public function getGenres()
    // {
    //     $response = $this->client->request('GET', "https://api.themoviedb.org/3/genre/movie/list?language=fr-FR&api_key=$this->apiKey", [
    //         'headers' => [
    //             'accept' => 'application/json',
    //         ],
    //     ]);

    //     $data = json_decode($response->getBody(), true); // json_decode()

    //     return $data['genres'];
    // }

    public function getFilmById($id)
    {
        $response = $this->client->request('GET', "https://api.themoviedb.org/3/movie/$id?append_to_response=credits,videos&language=fr-FR&api_key=$this->apiKey", [
            'headers' => [
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true); // json_decode()

        return $data;
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


    }
}