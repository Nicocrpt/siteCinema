<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acteur;
use App\Models\Film;
use App\Models\Realisateur;
use App\Models\Seance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminSeanceController extends Controller
{

    public function index(): View
    {
        $seances = Seance::all();
        return view('admin.seances.index', compact('seances'));
    }
    public function manage(): View
    {   

        return view('admin.seances.manage', [
            'seances' => Seance::all(),
            'films' => Film::with('certification')->get()
        ]);
    }

    public function getSeances(Request $request)
    {
        try {
            $salle = $request->get('salle');
            $start = Carbon::parse($request->get('start'));
            $end = Carbon::parse($request->get('end'));
            if ($salle != 'all') {
                $seances = Seance::whereBetween('datetime_seance', [$start, $end])->where('salle_id', (int) $salle)->get();
            } else {
                $seances = Seance::whereBetween('datetime_seance', [$start, $end])->get();
            }
            
            $events = [];

            foreach($seances as $seance){

                $editable = $seance->reservations->count() == 0 ? true : false; 
                $language = $seance->vf == 1 ? ' (VF)' : ' (VO)';
                $startDatetime = Carbon::parse($seance->datetime_seance);
                switch($seance->salle->id){
                    case 1:
                        $color = '#ef4444';
                        $colorBreak = '#a15d5d';
                        $salle = 1;
                        break;
                    case 3:
                        $color = '#0ea5e9';
                        $colorBreak = '#5584a3';
                        $salle = 3;
                        break;
                    case 2:
                        $color = '#22c55e';
                        $colorBreak = '#528756';
                        $salle = 2;
                        break;
                    default:
                        break;
                }

                $events[] = [
                    'title' => $seance->film->titre . $language,
                    'start' => $startDatetime->toIso8601String(),
                    'end' => $startDatetime->copy()->addMinutes((int) $seance->film->duree + 30)->toIso8601String(),
                    'reference' => $seance->reference,
                    'salle' => $salle,
                    'color' => $color,
                    'editable' => $editable,
                ];

            }
            // dd($events);
            return response()->json($events);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite lors de la recherche : ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getFilteredFilms(Request $request){

        $title = urldecode($request->query('query'));
        $filter = urldecode($request->query('filter'));

        if (empty($title) && $filter == 'all') {
            return response()->json(Film::all());
        } else if (!empty($title) && $filter == 'all') {
            return response()->json(Film::where('titre', 'like', '%' . $title . '%')->get());
        }

        switch ($filter) {
            case 'published':
                $filter = 1;
                break;
            case 'unpublished':
                $filter = 2;
                break;
            case 'upcoming':
                $filter = 3;
                break;
            case 'archived':
                $filter = 4;
                break;
            default:
                $filter = 0;
                break;
        }

        $films = Film::where('titre', 'like', '%' . $title . '%')->where('statut_id', $filter)->get();


        return response()->json($films);
    }

    public function store(Request $request) {
        
        try {
            $request->validate([
                'film' => ['required', 'integer'],
                'reference' => ['required', 'string', 'max:8'],
                'salle' => ['required', 'integer'],
                'datetime_seance' => ['required', 'date'],
                'langue' => ['required', 'integer']
            ]);

            $datetime_seance = Carbon::parse($request->datetime_seance)->format('Y-m-d H:i:s');

            Seance::create([
                'film_id' => $request->film,
                'reference' => $request->reference,
                'salle_id' => $request->salle,
                'datetime_seance' => $datetime_seance,
                'vf' => $request->langue,
                'dolby_vision' => 0,
                'dolby_atmos' => 0
            ]);
    
            return response()->json(['success' => true, 'message' => 'La séance a bien été ajoutée.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Une erreur s\'est produite lors de l\'ajout de la séance : ' . $e->getMessage()], 500);
        } 
    }

    public function update(Request $request) {
        try {
            $request->validate([
                'reference' => ['required', 'string', 'max:8'],
                'datetime_seance' => ['required', 'date'],
            ]);

            $datetime_seance = Carbon::parse($request->datetime_seance)->format('Y-m-d H:i:s');

            Seance::where('reference', $request->reference)->update([
                'datetime_seance' => $datetime_seance,
            ]);

            return response()->json(['success' => true, 'message' => 'La séance a bien été modifiée.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Une erreur s\'est produite lors de la modification de la séance : ' . $e->getMessage()], 500);
        }
    }

}
