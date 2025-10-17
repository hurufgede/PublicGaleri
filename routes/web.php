<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GaleriController;
use App\Models\Galeri;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('galeri', App\Http\Controllers\GaleriController::class);
