<?php

use App\Models\Ieraksti;
use App\Http\Controllers\IerakstiController;
use App\Http\Controllers\KomentariController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BalsojumiController;
use App\Http\Controllers\LocaleController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ieraksti', IerakstiController::class);

Route::get('/temas/{id}', [\App\Http\Controllers\TemasController::class, 'show'])->name('temas.show');


Route::post('komentari', [KomentariController::class, 'store'])->name('komentari.store');

// reģistrēšanās
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// pieslēgšanās
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// izrakstīšanās
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// balsojumi
Route::middleware(['auth'])->group(function () {
    Route::post('/komentars/{komentars}/vote', [BalsojumiController::class, 'vote'])->name('komentari.vote');
});

// valodas izvēle
Route::get('locale/{lang}', [LocaleController::class, 'setLocale'])->name('locale.switch');