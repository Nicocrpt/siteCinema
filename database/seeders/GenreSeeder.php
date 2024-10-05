<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\TmdbService;


class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // $tmdbClient = new TmdbService;

        // foreach ($tmdbClient->getgenres() as $genre) {
        //     Genre::create([
        //         'tmdb_id' => $genre['id'],
        //         'nom' => $genre['name'],
        //     ]);
        // }
    }
}
