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
        
        // $tmdbClient->addMovieToDb(335984);
        // $tmdbClient->addMovieToDb(329);
        // $tmdbClient->addMovieToDb(615777);
        // $tmdbClient->addMovieToDb(313369);
        // $tmdbClient->addMovieToDb(122);
        // $tmdbClient->addMovieToDb(82507);
        // $tmdbClient->addMovieToDb(586810);
        $tmdbClient->addMovieToDb(1184918);
        $tmdbClient->addMovieToDb(959604);
        $tmdbClient->addMovieToDb(889737);
        $tmdbClient->addMovieToDb(832964);
        $tmdbClient->addMovieToDb(1158996);
        $tmdbClient->addMovieToDb(974950);


        
    }

    

}
