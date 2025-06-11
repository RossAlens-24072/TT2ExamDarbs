<?php

use App\Models\Ieraksti;
use App\Http\Controllers\IerakstiController;
use App\Http\Controllers\KomentariController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ieraksti', IerakstiController::class);

Route::post('komentari', [KomentariController::class, 'store'])->name('komentari.store');
