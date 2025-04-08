<?php

namespace Database\Seeders;

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
        $tmdbClient = new TmdbService;
        
        // Perfect Blue
        $tmdbClient->addMovieToDb(10494, 1);

        // D&D
        $tmdbClient->addMovieToDb(493529, 1);

        // Contact
        $tmdbClient->addMovieToDb(686, 3);

        // Nausicaa
        $tmdbClient->addMovieToDb(81, 3);

        // Akira
        $tmdbClient->addMovieToDb(149, 1);

        // Babylon
        $tmdbClient->addMovieToDb(615777, 3);

        // La La Land
        $tmdbClient->addMovieToDb(313369, 3);

        // Interstellar
        $tmdbClient->addMovieToDb(157336, 1);

        // Le roi et l'oiseau
        $tmdbClient->addMovieToDb(22504, 3);


        // Films à l'affiche

        //Blade Runner 2049

        $tmdbClient->addMovieToDb(335984, 1);
        $movie = Film::where('tmdb_id', 335984)->first();
        $movie->update([
            'url_backdrop' => 'https://image.tmdb.org/t/p/original/ilRyazdMJwN05exqhwK4tMKBYZs.jpg',
            'url_logo' => 'https://image.tmdb.org/t/p/original/wa5oPNclj7ogyKJLpV8ADHxwy8b.png',
            'est_favori' => 1,
            'statut_id' => 2,
        ]);

        // Princesse Mononoke

        $tmdbClient->addMovieToDb(128, 3);
        $movie = Film::where('tmdb_id', 128)->first();
        $movie->update([
            'url_backdrop' => 'https://image.tmdb.org/t/p/original/wPwLLtHmtXS8JQ7wX9CeLoeW69Y.jpg',
            'url_logo' => 'https://image.tmdb.org/t/p/original/w29hHfCISGc0C82VgcOxKHTIBQZ.png',
            'url_trailer' => 'https://www.youtube.com/embed/cQq6aqTNUsA',
            'est_favori' => 1,
            'statut_id' => 2,
        ]);

        // Spider-Man : Across the spider-verse

        $tmdbClient->addMovieToDb(569094, 1);
        $movie = Film::where('tmdb_id', 569094)->first();
        $movie->update([
            'url_backdrop' => 'https://image.tmdb.org/t/p/original/3IlBBELuZszOkGtPHVBTWlYzWqu.jpg',
            'url_logo' => 'https://image.tmdb.org/t/p/original/mZK6Gt9YUqXC8vUCcdIGFhIjuzr.png',
            'est_favori' => 1,
            'statut_id' => 2,
        ]);
           
    }

    

}
