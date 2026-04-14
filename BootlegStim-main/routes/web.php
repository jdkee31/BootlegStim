<?php

use App\Http\Controllers\GamePageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Game / product page
Route::get('/games/{game}', [GamePageController::class, 'show'])->name('games.show');

// Profile pages
Route::get('/profile/{user}',         [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{user}/edit',    [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/{user}/update', [ProfileController::class, 'update'])->name('profile.update');