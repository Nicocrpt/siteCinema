<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Salle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seance>
 */
class SeanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $salle = Salle::all()->random();
        return [
            'salle_id' => $salle->id,
            'film_id' => Film::all()->random()->id,
            'datetime_seance' => fake('fr_FR')->dateTimeBetween('now', '+1 week'),
            'vf' => rand(0, 1),
        ];
    }
}
