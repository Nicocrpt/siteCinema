<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Place;
use App\Models\Reservation;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    public function index(): View
    {
        $today = now()->format('Y-m-d H:i:s');
        $seances = Seance::where('datetime_seance', '!=', $today)->with('film')->get()->pluck('film_id');
        $films = [];
        foreach($seances as $seance){
            $film = Film::where('id', $seance)->with('seances')->with('acteurs')->with('realisateurs')->with('genres')->first();
            if(!in_array($film, $films)){
                $films[] = $film;
            }
        }

        return view('seances.index', compact('films'));
    }

    public function show($reference): View
    {
        // $seance = Seance::where('reference', $reference)->with('film')->with('salle')->first();
        $seance = Seance::where('id', $reference)->with('film')->with('salle')->first();
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
            // 'seance' => Seance::where('reference', $reference)->with('salle')->with('film')->first()
            'seance' => Seance::where('id', $reference)->with('salle')->with('film')->first()
        ]);
        
        
        return redirect()->route('seances.buy', $reference);
    }

    public function buy($reference, Request $request): View
    {
        $places = $request->session()->get('places');
        $seance = $request->session()->get('seance');

        return view('seances.buy', compact('places', 'seance'));
    }


    public function getFilmsByDate(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required'
            ]);

            $filmsIds = Seance::whereDate('datetime_seance', $request->query('date'))->with('film')->get()->pluck('film_id');
            $films = [];
            foreach($filmsIds as $filmId){
                $film = Film::where('id', $filmId)->with('seances')->with('acteurs')->with('realisateurs')->with('genres')->first();
                if (!in_array($film, $films)) {
                    $films[] = $film;
                }
            }
            return response()->json($films);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la recherche : ' . $e->getMessage(),
            ], 500);
        }
    }
}
