<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CatigoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


// Guruhlar 
Route::get('/groups', [GroupController::class, 'index'])->name('groups');

// Catigory 
Route::get('/catigore', [CatigoryController::class, 'index'])->name('catigore');
Route::get('/catigore_create', [CatigoryController::class, 'create'])->name('catigore_create');
Route::get('/catigore_update/{id}', [CatigoryController::class, 'update'])->name('catigore_update');
Route::get('/catigore_show/{id}', [CatigoryController::class, 'show'])->name('catigore_show');

// Post 
Route::get('/post', [PostController::class, 'index'])->name('post');