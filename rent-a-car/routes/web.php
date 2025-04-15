<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\carsController;

Route::get('/', [carsController::class, 'index'])->name('home');