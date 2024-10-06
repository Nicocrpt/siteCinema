<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salles')->insert([
            [
                'nombre_places' => 280,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre_places' => 162,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre_places' => 112,
                'created_at' => now(),
                'updated_at' => now()
            ]
            ]);
    }
}
