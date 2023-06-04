<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
	public function getAllStatus()
	{
		$status = Status::all();
		return response()->json($status);
	}

	public function getStatus($id)
	{
		$status = Status::find($id);
		return response()->json($status);
	}

	public function createStatus(Request $request)
	{
		$status = new Status();
		$status->name = $request->name;
		$status->save();
		return response()->json($status);
	}

	public function updateStatus(Request $request, $id)
	{
		$status = Status::find($id);
		$status->name = $request->name;
		$status->save();
		return response()->json($status);
	}

	public function deleteStatus($id)
	{
		$status = Status::find($id);
		$status->delete();
		return response()->json('Removed successfully.');
	}
}
