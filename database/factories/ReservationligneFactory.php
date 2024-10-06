<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservationligne>
 */
class ReservationligneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randId = Reservation::all()->random()->id;

        $reservation = Reservation::find($randId);
        $place = $reservation->seance->salle->places->random();

        return [
            'reservation_id' => $randId,
            'place_id' => $place->id,
        ];

        
    }
}
