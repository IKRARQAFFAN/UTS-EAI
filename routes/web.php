<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\BookingsController;

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

Route::get('/', function () {
    return response()->json([
        'message' => 'Test API'
    ], 200);
});

Route::group(['prefix' => 'api'], function () {
    Route::get('hotels', [HotelsController::class, 'index']);
    Route::post('hotels', [HotelsController::class, 'store']);
    Route::put('hotels/{id}', [HotelsController::class, 'update']);
    Route::delete('hotels/{id}', [HotelsController::class, 'destroy']);

    Route::get('booking/{id}', [BookingsController::class, 'show']);
    Route::post('booking', [BookingsController::class, 'store']);
});
