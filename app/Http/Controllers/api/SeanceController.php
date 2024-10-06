<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Salle;
use App\Models\Seance;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $seances = Seance::query();

            if(request()->query('film')==='1') {
                $seances->with('film');
            }
            if(request()->query('salle')==='1') {
                $seances->with('salle');
            }

            $seances = $seances->get();
            return response()->json($seances);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la recherche : ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'film_id' => 'integer|required',
                'salle_id' => 'integer|required',
                'datetime_seance' => 'date|required',
                'vf' => 'boolean|required',
            ]);
            
            $nombrePlaces = Salle::find($request['salle_id'])->nombre_places;

            $seance = Seance::create([
                'film_id' => $request['film_id'],
                'salle_id' => $request['salle_id'],
                'datetime_seance' => $request['datetime_seance'],
                'vf' => $request['vf'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Seance ajoutée avec succès !',
                'data' => $seance
            ]);
                
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de l\'ajout de la séance : ' . $e->getMessage(),
            ]);
        }
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id)
    {
        try {
            $seance = Seance::find($id)->query();

            if ($request->query('film')==='1') {
                $seance->with('film');
            }
            if ($request->query('salle')==='1') {
                $seance->with('salle');
            }

            $seance = $seance->first();

            return response()->json($seance);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la recherche : ' . $e->getMessage(),
            ], 500);
        }
    }


    public function update(Request $request, int $id)
    {
        try {
               $validated = $request->validate([
                   'film_id' => 'integer|required',
                   'salle_id' => 'integer|required',
                   'datetime_seance' => 'date|required',
                   'vf' => 'boolean|required',
               ]);
               
               $seance = Seance::find($id)->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Seance modifié avec succès !',
                'data' => $seance
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la modification : ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Seance::destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Seance supprimée avec succès !',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la suppression : ' . $e->getMessage(),
            ]);
        }
    }
}
