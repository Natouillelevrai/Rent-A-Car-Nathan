<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;

Route::get('/', [ViewController::class, 'index'])->name('home');
Route::get('/vehicules', [ViewController::class, 'allVehicules'])->name('vehicules');
Route::get('/vehicule/{id}', [ViewController::class, 'vehicule'])->name('vehicules');