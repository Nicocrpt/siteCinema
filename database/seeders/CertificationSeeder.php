<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('certifications')->insert([
            [
                'valeur' => "12",
                'url_logo' => 'storage/certifications/12.png',
                'description' => "Peut contenir des scènes de violences et de harcèlement.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'valeur' => "16",
                'url_logo' => 'storage/certifications/16.png',
                'description' => "Peut contenir des scènes violentes ou à caractère sexuel",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'valeur' => "Touts publics",
                'description' => null,
                'url_logo' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'valeur' => "18",
                'url_logo' => 'storage/certifications/18.png',
                'description' => "Peut contenir des scènes sexuelles ou violentes explicites",
                'created_at' => now(),
                'updated_at' => now()
            ]
            ]);
    }
}
