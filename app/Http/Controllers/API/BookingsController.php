<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function getAllCottages()
	{
		$bookings = Booking::all();
		return response()->json($bookings);
	}
}
