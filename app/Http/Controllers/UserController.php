<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function homepage(): View
    {   
        
        $user = Auth::user();
        
        return view('users.account', compact('user'));
    }
}
