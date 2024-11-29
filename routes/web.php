<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CatigoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CardController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Guruhlar 
Route::get('/groups', [GroupController::class, 'index'])->name('groups');

// Catigory 
Route::get('/catigore', [CatigoryController::class, 'index'])->name('catigore');
Route::get('/catigore_create', [CatigoryController::class, 'create'])->name('catigore_create');
Route::post('/catigore_create_story', [CatigoryController::class, 'story'])->name('catigore_create_story');
Route::get('/catigore_update/{id}', [CatigoryController::class, 'update'])->name('catigore_update');
Route::put('/catigore_update_name/{id}', [CatigoryController::class, 'update_name'])->name('catigore_update_name');
Route::delete('/catigore_delete/{id}', [CatigoryController::class, 'delete'])->name('catigore_delete');
Route::delete('/catigore_delete_group/{id}', [CatigoryController::class, 'delete_group'])->name('catigore_delete_group');
Route::put('/catigore_add_chanel/{id}', [CatigoryController::class, 'add_chanel'])->name('catigore_add_chanel');

// Post 
Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/post_create', [PostController::class, 'create'])->name('post_create');
Route::post('/post_create_story', [PostController::class, 'story'])->name('post_create_story');
Route::get('/post_update/{id}', [PostController::class, 'update'])->name('post_update');
Route::put('/post_update_post/{id}', [PostController::class, 'update_story'])->name('post_update_post');
Route::delete('/post_create_delete/{id}', [PostController::class, 'delete'])->name('post_create_delete');

//Card
Route::get('/card', [CardController::class, 'index'])->name('card');
Route::get('/card_show_play/{id}', [CardController::class, 'show_play'])->name('card_show_play');
Route::get('/card_create', [CardController::class, 'create'])->name('card_create');
Route::get('/card_create_typing', [CardController::class, 'card_create_typing'])->name('card_create_typing');
Route::delete('/card_delete/{id}', [CardController::class, 'card_delete'])->name('card_delete');
Route::post('/card_create_story', [CardController::class, 'story'])->name('card_create_story');

