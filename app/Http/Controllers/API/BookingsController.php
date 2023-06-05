<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\BookingHasOptions;
use Illuminate\Support\Facades\DB;

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

	public function createBooking(Request $request)
	{
		DB::beginTransaction();

		try {
			$booking = new Booking();
			$booking->start_date = $request->start_date;
			$booking->end_date = $request->end_date;
			$booking->price = $request->totalPrice;
			$booking->name = $request->name;
			$booking->surname = $request->surname;
			$booking->email = $request->email;
			$booking->phone = $request->phone;
			$booking->persons = $request->persons;
			$booking->cottage_id = $request->cottage_id;
			$booking->status_id = $request->status_id;
			$booking->save();

			foreach ($request->options as $option) {
				$bookingHasOptions = new BookingHasOptions();
				$bookingHasOptions->booking_id = $booking->id;
				$bookingHasOptions->option_id = $option['id']; // this should be $option['id'] instead of $option->id
				$bookingHasOptions->save();
			}

			DB::commit();

			return response()->json($booking);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

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
