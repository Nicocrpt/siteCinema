<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Reservationligne;
use Illuminate\Http\Request;

class ReservationligneController extends Controller
{
    public function destroy($id)
    {   
        $ligne = Reservationligne::find($id);
        $reservation = $ligne->reservation;

        $ligne->is_active = false;
        $ligne->save();

        if ($reservation->reservationlignes->where('is_active', true)->count() == 0) {
            $reservation->is_active = false;
            $reservation->save();
            return response()->json(['success' => 'Reservation supprimée avec succès !'], 200);
        }

        return response()->json(['success' => 'Place supprimée avec succès !'], 200);
    }
}
