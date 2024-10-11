<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FilmController::class, 'welcomePage'])->name('index');

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('film.show');

Route::get('/seances', [SeanceController::class, 'index'])->name('seances.index');
Route::get('/seances/{id}', [SeanceController::class, 'show'])->name('seances.show');
Route::post('/seances/{id}', [SeanceController::class, 'transfer'])->name('seances.transfer');
Route::get('/seances/{id}/buy', [SeanceController::class, 'buy'])->name('seances.buy');

Route::resource('/reservations', ReservationController::class);

Route::get('/my-account', [UserController::class, 'homepage'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
