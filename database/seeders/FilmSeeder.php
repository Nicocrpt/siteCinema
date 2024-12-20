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


        // Films à l'affiche

        //Blade Runner 2049

        $tmdbClient->addMovieToDb(335984);
        $movie = Film::where('tmdb_id', 335984)->first()->get();
        $movie->update([
            'url_backdrop' => 'https://image.tmdb.org/t/p/original/9AU3kxNMM6AGofeC1uOtm4etsNj.jpg',
            'url_logo' => 'https://image.tmdb.org/t/p/original/wa5oPNclj7ogyKJLpV8ADHxwy8b.png',
            'est_favori' => 1,
        ]);

        // Princesse Mononoke

        $tmdbClient->addMovieToDb(128);
        $movie = Film::where('tmdb_id', 128)->first()->get();
        $movie->update([
            'url_backdrop' => 'https://image.tmdb.org/t/p/original/wPwLLtHmtXS8JQ7wX9CeLoeW69Y.jpg',
            'url_logo' => 'https://image.tmdb.org/t/p/original/w29hHfCISGc0C82VgcOxKHTIBQZ.png',
            'url_trailer' => 'https://www.youtube.com/embed/cQq6aqTNUsA',
            'est_favori' => 1,
        ]);

        // Spider-Man : Across the spider-verse

        $tmdbClient->addMovieToDb(569094);
        $movie = Film::where('tmdb_id', 569094)->first()->get();
        $movie->update([
            'url_backdrop' => 'https://image.tmdb.org/t/p/original/3IlBBELuZszOkGtPHVBTWlYzWqu.jpg',
            'url_logo' => 'https://image.tmdb.org/t/p/original/mZK6Gt9YUqXC8vUCcdIGFhIjuzr.png',
            'est_favori' => 1,
        ]);
        





        // DB::statement('
        //     INSERT INTO films (tmdb_id, titre, slug, url_affiche, url_backdrop, url_trailer, url_logo, duree, synopsis, tagline, langue_id, certification_id, date_sortie, a_laffiche, est_favori, created_at, updated_at) VALUES

        //     (
        //         335984, 
        //         "Blade Runner 2049", 
        //         "blade-runner-2049", 
        //         "https://image.tmdb.org/t/p/original/baCC3v1wLnmoBbr2aH0e7P312gv.jpg", 
        //         "https://image.tmdb.org/t/p/original/9AU3kxNMM6AGofeC1uOtm4etsNj.jpg", 
        //         "https://www.youtube.com/embed/O4C5cwSbXZ8", 
        //         "https://image.tmdb.org/t/p/original/wa5oPNclj7ogyKJLpV8ADHxwy8b.png", 
        //         "164", 
        //         "En 2049, la société est fragilisée par les nombreuses tensions entre les humains et leurs esclaves créés par bioingénierie. L\'officier K est un Blade Runner : il fait partie d\'une force d\'intervention d\'élite chargée de trouver et d\'éliminer ceux qui n\'obéissent pas aux ordres des humains. Lorsqu\'il découvre un secret enfoui depuis longtemps et capable de changer le monde, les plus hautes instances décident que c\'est à son tour d\'être traqué et éliminé. Son seul espoir est de retrouver Rick Deckard, un ancien Blade Runner qui a disparu depuis des décennies…", 
        //         "La clé de l\'avenir est enfin découverte.", 
        //         1, 
        //         3, 
        //         "2017-10-04T00:00:00Z", 
        //         1, 
        //         1, 
        //         "2024-10-13 12:20:41", 
        //         "2024-10-13 19:43:18"
        //     ),

            
        //     (128, "Princesse Mononoké", "princesse-mononoke", "https://image.tmdb.org/t/p/original/AulQiyP2PMQKW5Vm7PviGrFbpPm.jpg", "https://image.tmdb.org/t/p/original/wPwLLtHmtXS8JQ7wX9CeLoeW69Y.jpg", NULL, "https://image.tmdb.org/t/p/original/w29hHfCISGc0C82VgcOxKHTIBQZ.png", "135", "Au XVᵉ siècle, durant l\'ère Muromachi, la forêt japonaise, jadis protégée par des animaux géants, se dépeuple à cause de l\'homme. Un sanglier transformé en démon dévastateur en sort et attaque le village d\'Ashitaka, futur chef du clan Emishi. Touché par le sanglier qu\'il a tué, celui-ci est forcé de partir à la recherche du dieu Cerf pour lever la malédiction qui lui gangrène le bras.", "Les hommes sont bien plus dangereux que les dieux de la forêt.", 10, 3, "2000-01-12T00:00:00Z", 1, 1, "2024-10-13 12:35:03", "2024-10-13 13:44:33"),

            
        //     (569094, "Spider-Man : Across the Spider-Verse", "spider-man-across-the-spider-verse", "https://image.tmdb.org/t/p/original/hvfwCeSTgsExmz9l31dKkfR83DH.jpg", "https://image.tmdb.org/t/p/original/3IlBBELuZszOkGtPHVBTWlYzWqu.jpg", "https://www.youtube.com/embed/8j-skPUTkqs", "https://image.tmdb.org/t/p/original/mZK6Gt9YUqXC8vUCcdIGFhIjuzr.png", "140", "Après avoir retrouvé Gwen Stacy, Spider-Man, le sympathique héros originaire de Brooklyn, est catapulté à travers le Multivers, où il rencontre une équipe de Spider-Héros chargée d\'en protéger l\'existence. Mais lorsque les héros s\'opposent sur la façon de gérer une nouvelle menace, Miles se retrouve confronté à eux et doit redéfinir ce que signifie être un héros afin de sauver les personnes qu\'il aime le plus.", "Pendant ce temps-là dans un autre autre univers...", 1, 3, "2023-05-31T00:00:00Z", 1, 1, "2024-10-13 13:04:00", "2024-10-13 13:05:02");
        // ');


        
    }

    

}
