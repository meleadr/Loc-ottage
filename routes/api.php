<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CottagesController;
use App\Http\Controllers\API\BookingsController;
use App\Http\Controllers\API\StatusController;

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

Route::controller(AuthController::class)->group(function () {
	Route::post('/auth/login', 'login');
});

Route::controller(CottagesController::class)->group(function () {
	Route::get('/cottages/getAllCottages', 'getAllCottages');
	Route::get('/cottages/getCottage/{id}', 'getCottage');
});

Route::controller(BookingsController::class)->group(function () {
	Route::get('/bookings/getAllBookings', 'getAllBookings');
	Route::post('/bookings/updateStatus/{id}', 'updateStatus');
	Route::post('/bookings/createBooking', 'createBooking');
});

Route::controller(StatusController::class)->group(function () {
	Route::get('/status/getAllStatus', 'getAllStatus');
});
