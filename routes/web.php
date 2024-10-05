<?php

use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/films', [FilmController::class, 'getfilms'])->name('films.index');
Route::get('/films/{id}', [FilmController::class, 'getfilm'])->name('film.show');
