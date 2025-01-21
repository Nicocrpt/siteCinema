<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminFilmController;
use App\Http\Controllers\Admin\AdminSeanceController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationligneController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\UserController;
use App\Models\Reservationligne;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;


// Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/films/add/search', [AdminFilmController::class, 'searchPage'])->name('admin.films.searchPage');
    Route::get('/admin/films', [AdminFilmController::class, 'manage'])->name('admin.films.manage');
    Route::get('/admin/films/manage/{id}', [AdminFilmController::class, 'edit'])->name('admin.films.edit');
    // Requetes ajax
    Route::get('/admin/films/search-movie', [AdminFilmController::class, 'searchFilms'])->name('admin.films.searchFilms');
    // Fin requetes ajax
    Route::get('/admin/films/add/{id}', [AdminFilmController::class, 'create'])->name('admin.films.create');
    Route::post('/admin/films/add', [AdminFilmController::class, 'store'])->name('admin.films.store');


    Route::get('/admin/seances', [AdminSeanceController::class, 'index'])->name('admin.seances.index');
    Route::get('/admin/seances/manage', [AdminSeanceController::class, 'manage'])->name('admin.seances.manage');
    // Requetes ajax
    Route::get('/admin/seances/get-seances', [AdminSeanceController::class, 'getSeances']);
    Route::get('/admin/seances/get-films', [AdminSeanceController::class, 'getFilteredFilms'])->name('admin.seances.getFilteredFilms');
    Route::post('/admin/seances/add', [AdminSeanceController::class, 'store'])->name('admin.seances.store');
    Route::patch('/admin/seances/{id}', [AdminSeanceController::class, 'update'])->name('admin.seances.update');
    // Fin requetes ajax
// });