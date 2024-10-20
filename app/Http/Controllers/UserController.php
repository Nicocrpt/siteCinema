<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function homepage()
    {   

        $user = Auth::user();

        if ($user)
        {
            return view('users.account', compact('user'));
        }else
        {
            return redirect()->route('login');
        }
        
        
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'Nom' => ['required', 'string', 'max:255'],
            'Prenom' => ['required', 'string', 'max:255',],
            'Mail' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'Telephone' => ['required', 'string', 'max:255'],
        ],
        [
            'Nom.required' => 'Ce nom n\'est pas valide.',
            'Prenom.required' => 'Ce prénom n\'est pas valide.',
            'Mail.required' => 'Cet email n\'est pas valide.',
            'Telephone.required' => 'Ce téléphone n\'est pas valide.',

        ]);

        try {
            $user->update([
                'nom' => $request->Nom,
                'prenom' => $request->Prenom,
                'email' => $request->Mail,
                'telephone' => $request->Telephone,
            ]);

            return redirect()->back()->with('success', 'Vos informations ont bien été mises à jour.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue.');
        }
    }

        
    
}
