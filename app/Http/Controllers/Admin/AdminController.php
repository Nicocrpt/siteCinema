<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Salle;
use App\Models\Seance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(): View
    {
        $films = Film::all();
        $seances = Seance::all();
        $salles = Salle::all();
        
        return view('admin.index');
    }
}
