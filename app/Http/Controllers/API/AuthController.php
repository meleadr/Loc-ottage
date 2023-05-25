<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

	public function login(Request $request)
	{
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			$user = $request->user();
			$token = $user->createToken('MyApp')->plainTextToken;

			return response()->json([
				'success' => true,
				'message' => 'Utilisateur connecté',
				'user' => $user,
				'token' => $token
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Le mot de passe ne correspond pas',
			], 200);
		}
	}
}
