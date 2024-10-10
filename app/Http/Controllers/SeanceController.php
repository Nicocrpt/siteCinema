<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Seance;
use Illuminate\Contracts\View\View;
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

        return view('seances.show', compact('seance'));
    }
}
