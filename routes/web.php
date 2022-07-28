<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//Homepage
Route::get('/', function () {
    return view('shortener');
})->name('homepage');

//Shorten the URL
Route::post('shorten', [LinkController::class, 'store']);

//Login&Register Form Pages(view)
Route::get('login', [UserController::class, 'showLogin'])->middleware('guest')->name('login');
Route::get('register', [UserController::class, 'showRegister'])->middleware('guest');

//Login&Register
Route::post('login', [UserController::class, 'login'])->middleware('guest');
Route::post('register', [UserController::class, 'register'])->middleware('guest');

//Simple Stats Page
Route::get('stats/{short_path}', [StatsController::class, 'stats']);

//Dashboard
Route::get('dashboard', [StatsController::class, 'dashboard'])->middleware('auth');

//Delete URL
Route::delete('delete/{id}', [LinkController::class, 'destroy'])->middleware('auth');

//Logout
Route::get('logout', [UserController::class, 'logout'])->middleware('auth');

//Redirect to Real URL
Route::get('/{short_path}', [LinkController::class, 'redirect']);
