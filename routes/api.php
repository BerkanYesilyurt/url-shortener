<?php

use App\Http\Controllers\api\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Shorten the URL
Route::post('links', [LinkController::class, 'store'])->middleware('api');

//Details of Link
Route::get('links/{short_path}', [LinkController::class, 'getDetails'])->middleware('api');
