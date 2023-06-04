<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function getAllBookings()
	{
		$bookings = Booking::all();
		return response()->json($bookings);
	}

	public function getBooking($id)
	{
		$booking = Booking::find($id);
		return response()->json($booking);
	}

	public function createBooking(Request $request)
	{
		$booking = new Booking();
		$booking->cottage_id = $request->cottage_id;
		$booking->user_id = $request->user_id;
		$booking->start_date = $request->start_date;
		$booking->end_date = $request->end_date;
		$booking->save();
		return response()->json($booking);
	}

	public function updateBooking(Request $request, $id)
	{
		$booking = Booking::find($id);
		$booking->cottage_id = $request->cottage_id;
		$booking->user_id = $request->user_id;
		$booking->start_date = $request->start_date;
		$booking->end_date = $request->end_date;
		$booking->save();
		return response()->json($booking);
	}

	public function deleteBooking($id)
	{
		$booking = Booking::find($id);
		$booking->delete();
		return response()->json('Removed successfully.');
	}
}
