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

	public function getAllBookingsFromCottage($id)
	{
		$bookings = Booking::where('cottage_id', $id)->get();
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
		$booking->start_date = date('Y-m-d', strtotime($request->startDate));
		$booking->end_date = date('Y-m-d', strtotime($request->endDate));
		$booking->price = $request->totalPrice;
		$booking->name = $request->name;
		$booking->surname = $request->surname;
		$booking->email = $request->email;
		$booking->phone = $request->phone;
		$booking->persons = $request->persons;
		$booking->cottage_id = $request->cottage_id;
		 foreach($request->options as $option) {
			$booking->options()->attach($option['id']);
		}
		$booking->status_id = $request->status_id;
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

	public function updateStatus(Request $request, $id)
	{
		$booking = Booking::find($id);
		$booking->status_id = $request->status_id;
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
