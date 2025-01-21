<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuts')->insert([
            [
                'etat' => "A l'affiche",
            ],
            [
                'etat' => "En attente",
            ],
            [
                'etat' => "Prochainement",
            ],
            [
                'etat' => "Archivé",
            ],
        ]);
    }
}
