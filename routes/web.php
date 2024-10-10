<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FilmController::class, 'welcomePage'])->name('index');

Route::get('/films', [FilmController::class, 'getfilms'])->name('films.index');
Route::get('/films/{id}', [FilmController::class, 'getfilm'])->name('film.show');

Route::get('/my-account', [UserController::class, 'homepage'])->name('home');
