<?php

namespace App\Http\Controllers;

use App\Models\Cottage;
use Illuminate\Http\Request;

class NomDuControleur extends Controller
{
    public function index()
    {
        $cottages = Cottage::all();
        return $cottages;
    }
}
