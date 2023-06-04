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

	public function addCottage()
	{
		$cottage = new Cottage();
		$cottage->name = request('name');
		$cottage->area = request('area');
		$cottage->bedrooms = request('bedrooms');
		$cottage->bathrooms = request('persons');
		$cottage->description = request('description');
		$cottage->price = request('price');
		$cottage->image = request('image_url');
		$cottage->save();
		return response()->json($cottage);
	}
}
