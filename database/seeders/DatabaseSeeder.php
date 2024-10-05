<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Insertions des pays

        $this->call(PaysSeeder::class);

        // Insertions des salles

        $this->call(SalleSeeder::class);

        //Insertions des places

        $this->call(PlaceSeeder::class);

        $this->call(GenreSeeder::class);

        $this->call(FilmSeeder::class);
    }
}
