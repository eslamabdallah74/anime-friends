<?php

use App\Http\Controllers\Anime\AnimeStoreController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/',HomePageController::class)->name('Home');
Route::get('/register',RegisterController::class)->name('Register');
Route::get('/login',LoginController::class)->name('login');

Route::middleware(['auth'])->group(function () {
    // Anime
    Route::post('/anime',AnimeStoreController::class);
});

