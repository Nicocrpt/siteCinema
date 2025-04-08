<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Reservationligne;
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

        $reservation = Reservation::with('seance.salle.places', 'seance.placesReservees')->inRandomOrder()->first();

        $placesReservees = $reservation->seance->placesReservees->map(function ($ligne) {
            return $ligne->place_id;
        })->toArray();
        $placesTotal = $reservation->seance->salle->places->map(function ($place) {
            return $place->id;
        })->toArray();
        

        $placesDisponibles = array_diff($placesTotal, $placesReservees);

        

        if (empty($placesDisponibles)) {
            throw new \Exception("plus de places");
        }

        $place = $placesDisponibles[array_rand($placesDisponibles)];

        return [
            'reservation_id' => $reservation->id,
            'seance_id' => $reservation->seance_id,
            'place_id' => $place,
            'prix' => [9,6][rand(0,1)]
        ];

        
    }
}
