<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Seance;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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

            $output = [
                'message' => 'Vos informations ont bien été mises à jour',
                'updated_data' => [
                    'Nom' => $user->nom,
                    'Prenom' => $user->prenom,
                    'Mail' => $user->email,
                    'Telephone' => $user->telephone,
                    'Adresse' => $user->adresse,
                    'CodePostal' => $user->code_postal,
                    'Ville' => $user->ville
                ]
            ];

            // return redirect()->back()->with('success', 'Vos informations ont bien été mises à jour.');
            return response()->json($output, 200);
        } catch (\Throwable $th) {
            // return redirect()->back()->with('error', 'Une erreur est survenue.');
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }


    public function destroy()
    {
        $user = Auth::user();
        isset($user) ? $user->delete() : null;

        Auth::logout();

        return redirect()->route('users.destroyed');
    }

    public function showReservation($reference)
    {   
        try {
            $reservation = Reservation::where('reference',$reference)->with('reservationlignes')->first();
            if ($reservation->user != Auth::user())
            {
                return redirect()->back()->with('error', 'Cette reservation n\'existe pas.');
            }
            $seance = Seance::where('id', $reservation->seance_id)->with('film')->first();

            return view('reservation.details', compact('reservation', 'seance'));

        } catch (\Exception $e) {
            // return redirect()->back()->with('error', 'Une erreur est survenue.');
            return response()->json(['error' => $e], 500);
        }

    }

    public function destroyed()
    {
        if (Auth::user())
        {
            return redirect()->route('home');
        }
        else
        {
            return view('users.accountDeleted');
        }
    }

        
    
}
