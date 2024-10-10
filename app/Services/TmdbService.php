<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Acteur;
use App\Models\Certification;
use App\Models\Compositeur;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Langue;
use App\Models\Pays;
use App\Models\Production;
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
        $this->apiKey = env('TMDB_API_KEY'); 
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

        $responseRD = $this->client->request('GET', "https://api.themoviedb.org/3/movie/$id/release_dates?language=fr-FR&api_key=$this->apiKey", [
            'headers' => [
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true); // json_decode()
        $dataRD = json_decode($responseRD->getBody(), true); 
        foreach ($dataRD['results'] as $result)
        {// json_decode()
            if ($result['iso_3166_1'] == "FR") {
                $item = $result['release_dates'][0];
                if($item['certification'] =='U' || $item['certification'] == 'TP' || $item['certification'] == '') {
                    $certification = 'Touts publics';
                }
                $dateSortie = $item['release_date'];
            }
        }
        
        $data['certification'] = $certification;
        $data['date_sortie'] = $dateSortie;

        return $data;
    }


    public function addMovieToDb($id): void
    {
        $tmdbClient = new TmdbService;

        $movie = $tmdbClient->getFilmById($id);

        $trailer = null;
        foreach ($movie['videos']['results'] as $video) {
            if ($video['type'] == 'Trailer') {
                if($video['iso_639_1'] == 'fr' && $video['site'] == 'YouTube' && preg_match('/\b(VF|VOST|VOSTF)\b/i', $video['name'])) {
                    $trailer = $video['key'];
                }
            }
        }
        if ($trailer) {
            $trailer = "https://www.youtube.com/embed/$trailer";
        }
        

        

        DB::table('films')->insert([
            'tmdb_id' => $movie['id'],
            'slug' => Str::slug($movie['title']),
            'titre' => $movie['title'],
            'synopsis' => $movie['overview'],
            'certification_id' => Certification::where('valeur', $movie['certification'])->first()->id,
            'date_sortie' => $movie['date_sortie'],
            'langue_id' => Langue::where('iso_2', $movie['original_language'])->first()->id,
            'url_affiche' => 'https://image.tmdb.org/t/p/original' . $movie['poster_path'],
            'url_trailer' => $trailer,
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
            if($prod['origin_country'] === ""){
                $prod['origin_country'] = "XX";
            }
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