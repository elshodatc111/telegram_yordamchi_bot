<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CatigoryController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


// Guruhlar 
Route::get('/groups', [GroupController::class, 'index'])->name('groups');

// Catigory 
Route::get('/catigore', [CatigoryController::class, 'index'])->name('catigore');