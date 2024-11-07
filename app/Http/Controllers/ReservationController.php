<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Reservation;
use App\Models\Reservationligne;
use App\Models\Seance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'seance' => 'required',
            'places' => 'required',
            'prices' => 'required',
            'email' =>  ['email', 'max:255']
        ]);

        
        $places = explode(',', $request['places']);
        $prices = explode(',', $request['prices']);

        Reservation::create([
            'seance_id' => $request['seance'],
            'reference' => uniqid(),
            'user_id' => Auth::id() ?? null,
            'guest_mail' => $request['email'] ?? null
        ]);

        
        foreach($places as $place){
            Reservationligne::create([
                'reservation_id' => Reservation::latest()->first()->id,
                'place_id' => Place::where('rangee', substr($place, 0, 1))->where('numero', substr($place, 1))->where('salle_id', Seance::where('id', $request['seance'])->first()->salle_id)->first()->id,
                'prix' => $prices[array_search($place, $places)]
            ]);
        };
        

        return redirect()->route('reservations.validated', Reservation::latest()->first()->reference);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Reservation $reservation)
    {   
        try {
            $reservation->is_active = false;
            $reservation->save();
            return response()->json(['success' => 'Reservation annulée avec succès !'], 200);
        } catch (\Exception $e) {
            return response()->json(['erreur' => 'Une erreur s\'est produite lors de la suppression'], 500);
        }
        
    }


    public function validated($reference): View
    {
        $reservation = Reservation::where('reference', $reference)->with('reservationlignes')->first();
        $places_id = $reservation->reservationlignes->pluck('place_id')->toArray();
        $places = Place::whereIn('id', $places_id)->get();


        return view('reservation.validated', compact('reservation', 'places'));
    }

    public function loadMore(Request $request)
    {
        $skip = $request->query('skip');
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->orderBy('created_at', 'desc')->skip($skip)->take(2)->get();
        $reservationCount = Reservation::where('user_id', $user->id)->count();
        
        $renderedComponents = [];

        foreach($reservations as $reservation){
            $renderedComponents[] = view('components.cards.reservation-card', ['reservation' => $reservation, 'status' => $reservation->is_active ? '': 'grayscale'])->render();
        }
        $status = $reservations->count() > 0 ? 'OK' : 'KO';


        return response()->json([
            'status' => $status,
            'reservations' => $renderedComponents,
            'nbReservations' => $reservationCount
        ], 200);
    }
}
