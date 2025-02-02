<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminFilmController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationligneController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\UserController;
use App\Models\Reservationligne;
use Illuminate\Support\Facades\Route;





Route::get('/', [FilmController::class, 'welcomePage'])->name('index');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/film/{id}', [FilmController::class, 'show'])->name('film.show');
Route::get('/query-films', [FilmController::class, 'userQuery'])->name('films.query');
//ajax films
Route::get('/films/get-films', [FilmController::class, 'getFilms']);
//fin ajax


Route::get('/seances', [SeanceController::class, 'index'])->name('seances.index');
Route::get('/seance/{id}', [SeanceController::class, 'show'])->name('seances.show');
Route::post('/seance/{id}', [SeanceController::class, 'transfer'])->name('seances.transfer');
Route::get('/seance/{id}/buy', [SeanceController::class, 'buy'])->name('seances.buy');
//ajax seances
Route::get('/seances/get-seances-by-date', [SeanceController::class, 'getFilmsByDate'])->name('seances.getFilmsByDate');
// fin ajax

Route::get('/reservations/load-more', [ReservationController::class, 'loadMore'])->name('reservations.loadmore');
Route::resource('/reservations', ReservationController::class);
Route::get('/reservations/{id}/validated', [ReservationController::class, 'validated'])->name('reservations.validated');


Route::delete('reservationlignes/{reservation}', [ReservationligneController::class, 'destroy'])->name('reservationlignes.destroy');

Route::get('/my-account', [UserController::class, 'homepage'])->name('home');
Route::put('/my-account/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/my-account/destroy', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/my-account/destroyed', [UserController::class, 'destroyed'])->name('users.destroyed');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboardCanceled');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

