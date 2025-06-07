<?php

use App\Models\Ieraksti;
use App\Http\Controllers\IerakstiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ieraksti', IerakstiController::class);

