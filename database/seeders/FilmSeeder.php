<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Pays;
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
    }

    public function addMovieToDb($id): void
    {
        $tmdbClient = new TmdbService;

        $movie = $tmdbClient->getFilmById($id);

        foreach ($movie['credits']['crew'] as $person) {
            if ($person['job'] === 'Director') {
                $director= $person['name'];
                break;
            }
        }

        DB::table('films')->insert([
            'tmdb_id' => $movie['id'],
            'slug' => Str::slug($movie['title']),
            'realisateur' => $director,
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
    }

}
