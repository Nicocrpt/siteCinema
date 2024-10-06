<?php

namespace Database\Seeders;

use App\Models\Reservationligne;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationligneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservationligne::factory(20)->create();
    }
}
