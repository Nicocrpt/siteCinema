<?php

use App\Http\Controllers\Admin\Api\AdminReservationController;
use App\Http\Controllers\api\FilmController;
use App\Http\Controllers\api\SeanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('films', FilmController::class);
Route::post('films/get-data', [FilmController::class, 'send']);
Route::post('films/manual', [FilmController::class, 'adminAdd']);
Route::get('tmdb/{id}',[FilmController::class, 'getFilm']);
Route::post('/reservation/check', [AdminReservationController::class, 'checkReservation']);

Route::apiResource('seances', SeanceController::class);