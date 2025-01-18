<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class AdminSeanceController extends Controller
{

    public function index(): View
    {
        $seances = Seance::all();
        return view('admin.seances.index', compact('seances'));
    }
    public function manage(): View
    {
        $seances = Seance::all();
        return view('admin.seances.manage', compact('seances'));
    }


}
