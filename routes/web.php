<?php

use App\Http\Controllers\LinkController;
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
});

//Shorten the URL
Route::post('shorten', [LinkController::class, 'store']);

//Login&Register Form Pages(view)
Route::get('login', [UserController::class, 'showLogin']);
Route::get('register', [UserController::class, 'showRegister']);

//Login&Register
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

//Dashboard
Route::get('dashboard', [LinkController::class, 'dashboard']);

//Logout
Route::get('logout', [UserController::class, 'logout']);

//Redirect to Real URL
Route::get('/{short_path}', [LinkController::class, 'redirect']);
