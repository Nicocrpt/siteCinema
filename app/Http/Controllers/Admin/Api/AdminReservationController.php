<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;

class AdminReservationController extends Controller
{
    public function checkReservation(Request $request){

        if (Auth::guard('sanctum')->check()) {
            return response()->json([
                'responseCode' => 1000,
                'message' => "Token d'authentification invalide ou absent"
            ], 401);
        }

        try {
            $request->validate([
                'reference' => 'required',
                'datetime' => 'required'
            ]);

            $reservation = Reservation::where('reference', $request['reference'])->with('reservationlignes')->first() ?? null;


            if (!$reservation) {
                
                return response()->json([
                    'responseCode' => 1001,
                    'message' => 'Reservation introuvable'
                ], 404);
            }

            if ($reservation->is_active) {

                $date = Carbon::parse($request['datetime']);
                $datetimeSeance = Carbon::parse($reservation->seance->datetime_seance);
                $checkTimeRange = false;

                if ($datetimeSeance <= $date->subMinutes(15)){

                    $seance = Seance::where('id', $reservation->seance_id)->with('film')->with('salle')->first();
 
                    
                    return response()->json([
                        'responseCode' => 1004,
                        'message' => 'La séance commence dans plus de 15min, veuillez rééssayer plus tard',
                        'data' => [
                            'film' => [
                                'titre' => $seance->film->titre,
                            ],
                            'salle' => 'Salle ' . $seance->salle->id,
                            'datetimeSeance' => $seance->datetime_seance
                        ]
                    ], 400);
                }

                if ($datetimeSeance>= $date->addMinutes($reservation->seance->film->duree)){
                    return response()->json([
                        "responseCode" => 1005,
                        "message" => "La réservation est expirée",
                    ], 400);
                }

                //$reservation->is_active = false;
                //$reservation->save();
                $seance = Seance::where('id', $reservation->seance_id)->with('film')->with('salle')->first();

                
                return response()->json([
                    'responseCode' => 2000,
                    'message' => 'Réservation Validée',
                    'data' => [
                        'film' => [
                            'titre' => $seance->film->titre,       
                        ],
                        'salle' => 'Salle ' . $seance->salle->id,
                        'places' => $reservation->reservationlignes->count(),
                        'datetimeSeance' => $seance->datetime_seance
                    ]
                ], 200);
            } else {
                return response()->json([
                    'responseCode' => 1003,
                    'message' => 'La réservation a été annulée'
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'responseCode' => 1,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
