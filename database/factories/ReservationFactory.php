<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Reservationligne;
use App\Models\Seance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => fake('fr_FR')->ean8(),
            'seance_id' => Seance::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Reservation $reservation) {
            Reservationligne::factory(1)->create(['reservation_id' => $reservation->id]);
        });
    }
}
