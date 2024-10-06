<?php

namespace Database\Seeders;

use App\Models\Acteur;
use App\Models\Compositeur;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Langue;
use App\Models\Pays;
use App\Models\Realisateur;
use App\Services\TmdbService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $this->addMovieToDb(335984);
        $this->addMovieToDb(329);
        $this->addMovieToDb(615777);
        $this->addMovieToDb(313369);
        $this->addMovieToDb(339964);
        $this->addMovieToDb(122);
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


    }

}
