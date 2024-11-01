<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Place;
use App\Models\Reservation;
use App\Models\Seance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    public function index(): View
    {
        $films = Film::all();

        return view('seances.index', compact('films'));
    }

    public function show($reference): View
    {
        $seance = Seance::where('reference', $reference)->with('film')->with('salle')->first();
        $reservations = Reservation::where('seance_id', $seance->id)->with('reservationlignes')->get();
        $places = [];
        foreach($reservations as $reservation){
            foreach($reservation->reservationlignes->where('is_active', true) as $reservationLigne){
                $rangee = $reservationLigne->place->rangee;
                $numero = $reservationLigne->place->numero;
                $places[] = "$rangee$numero";
            };
        };
        

        return view('seances.show', compact('seance', 'places'));
    }

    public function transfer($reference, Request $request):RedirectResponse
    {   
        $request->validate([
            'seats' => 'required'
        ],
        [
            'seats.required' => 'Veuillez selectionner au moins un siege'
        ]);

        session([
            'places' => explode(',', $request->seats),
            'seance' => Seance::where('reference', $reference)->with('salle')->with('film')->first()
        ]);
        
        
        return redirect()->route('seances.buy', $reference);
    }

    public function buy($reference, Request $request): View
    {
        $places = $request->session()->get('places');
        $seance = $request->session()->get('seance');

        return view('seances.buy', compact('places', 'seance'));
    }


//     public function clearSeats(Request $request)
// {
//     // Efface les sièges de la session
//     $request->session()->forget('seats');

//     return redirect()->route('selection'); // Redirige vers la page de sélection
//}
}
