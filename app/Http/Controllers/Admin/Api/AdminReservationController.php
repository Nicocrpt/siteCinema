<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Seance;
use Illuminate\Http\Request;
use LDAP\Result;

class AdminReservationController extends Controller
{
    public function checkReservation(Request $request){

        try {
            $request->validate([
                'reference' => 'required'
            ]);

            $reservation = Reservation::where('reference', $request['reference'])->with('reservationlignes')->first();

            if (!$reservation) {
                return response()->json([
                    'Error' => 'Reservation introuvable'
                ]);
            }

            if ($reservation->is_active) {

                $reservation->is_active = false;
                $reservation->save();
                $seance = Seance::where('id', $reservation->seance_id)->with('film')->with('salle')->first();
                
                return response()->json([
                    'success' => 'Réservation Validée',
                    'data' => [
                        'film' => [
                            'titre' => $seance->film->titre,
                            'image' => $seance->film->url_affiche,        
                        ],
                        'salle' => 'Salle ' . $seance->salle->id,
                    ]
                ]);
            } else {
                return response()->json([
                    'error' => 'Réservation déjà validée'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
