<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HistoriqueBooking;
use Illuminate\Http\Request;

class HistoriqueBookingsController extends Controller
{
	public function getAllHistoriqueBookings()
	{
		$historiqueBookings = HistoriqueBooking::all();
		return response()->json($historiqueBookings);
	}

	public function getHistoriqueBooking($id)
	{
		$historiqueBooking = HistoriqueBooking::find($id);
		return response()->json($historiqueBooking);
	}

	public function createHistoriqueBooking(Request $request)
	{
		$historiqueBooking = new HistoriqueBooking();
		$historiqueBooking->id_booking = $request->id_user;
		$historiqueBooking->id_user = $request->id_user;
		$historiqueBooking->id_status_before = $request->id_status_before;
		$historiqueBooking->id_status_after = $request->id_status_after;
		$historiqueBooking->save();
		return response()->json($historiqueBooking);
	}

	public function deleteHistoriqueBooking($id)
	{
		$historiqueBooking = HistoriqueBooking::find($id);
		$historiqueBooking->delete();
		return response()->json('Removed successfully.');
	}
}
