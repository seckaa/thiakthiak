<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('get_new_order', 'OrderController@get_new_order');

Route::get('get_new_order',  [OrderController::class, 'get_new_order']);


Route::post('push-subscribe{user}',  [UserController::class, 'push']);
