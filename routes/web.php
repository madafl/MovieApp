<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[MovieController::class,'index'])->name('movies.index');
Route::get('/movies/{movie}',[MovieController::class,'show'])->name('movies.show');

Route::get('/actors',[ActorsController::class,'index'])->name('actors.index');
Route::get('/actors/{actor}',[ActorsController::class,'show'])->name('actors.show');

Route::post('/watched/{id}',[MovieController::class,'watched'])->name('watched');
Route::post('/watchlist/{id}',[MovieController::class,'watchlist'])->name('watchlist');

Route::post('/deletewatched/{id}',[MovieController::class,'deleteWatched'])->name('deleteWatched');
Route::post('/deletewatchlist/{id}',[MovieController::class,'deleteWatchlist'])->name('deleteWatchlist');

Route::post('/search/{word}',[MovieController::class,'search'])->name('search');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/profile',[UserController::class,'index'])->name('profile');
// ^^^^ this shouldnt work if not logged in 