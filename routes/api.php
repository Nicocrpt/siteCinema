<?php

use App\Http\Controllers\api\FilmController;
use App\Http\Controllers\api\SeanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('films', FilmController::class);

Route::apiResource('seances', SeanceController::class);