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
        for ($i = 0; $i < 350; $i++) {
            try {
                Reservationligne::factory()->create();
            } catch (\Exception $e) {

            }
        }
    }
}
