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
                'reference' => 'required|exists:reservations,reference'
            ]);

            $reservation = Reservation::where('reference', $request['reference'])->with('reservationlignes')->first();

            if ($reservation->is_active) {

                $reservation->is_active = false;
                $reservation->save();
                $seance = Seance::where('id', $reservation->seance_id)->with('film')->with('salle')->first();
                
                return response()->json([
                    'success' => 'Opération effecutée',
                    'data' => [
                        'status' => 'Reservation validée',
                        'reservation' => $reservation,
                        'seance' => $seance,
                    ]
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Opération non effecutée'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
