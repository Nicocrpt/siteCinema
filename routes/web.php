<?php

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

Route::get('/admin', [AdminFilmController::class, 'index'])->name('admin.index');
Route::get('/admin/films/search', [AdminFilmController::class, 'searchFilms'])->name('admin.films.searchFilms');
Route::get('/admin/films/create/{id}', [AdminFilmController::class, 'create'])->name('admin.films.create');

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('film.show');
Route::get('/query-films', [FilmController::class, 'userQuery'])->name('films.query');


Route::get('/seances', [SeanceController::class, 'index'])->name('seances.index');
Route::get('/seances/{id}', [SeanceController::class, 'show'])->name('seances.show');
Route::post('/seances/{id}', [SeanceController::class, 'transfer'])->name('seances.transfer');
Route::get('/seances/{id}/buy', [SeanceController::class, 'buy'])->name('seances.buy');

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

