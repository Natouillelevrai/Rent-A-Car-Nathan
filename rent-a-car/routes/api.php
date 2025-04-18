<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\carsController;

Route::get('/cars', [carsController::class, 'getAll'])->name('cars');
Route::get('/cars/{id}', [carsController::class, 'getById'])->name('getVehiculeById');

Route::post('/booking', [carsController::class, 'saveInDb'])->name('booking');