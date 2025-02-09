<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required',
                'password' => 'required',
            ]);
            if(Auth::attempt(['nom' => $request->name, 'password' => $request->password])){ 

                if (Auth::user()->is_admin) {
                    $user = User::find(Auth::user()->id);
                    $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
                    $success['name'] =  $user->nom;
                    return response()->json(['success' => true,
                    'user' => $success], 200);
                } else {
                    return response()->json(['success' => false,
                        'error' => 'User find but Not Admin'], 401);
                }
            
            } else {
                return response()->json(['success' => false,
                    'error' => 'User not found'], 401);
            }
        }catch (\Exception $e) {
            return response()->json(['success' => false,
                'error' => $e->getMessage()], 401);
        }
    }

}
