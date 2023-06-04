<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cottage;

class CottagesController extends Controller
{
    public function getAllCottages()
	{
		$cottages = Cottage::all();
		return response()->json($cottages);
	}

	public function getCottage($id)
	{
		$cottage = Cottage::find($id);
		return response()->json($cottage);
	}
}
