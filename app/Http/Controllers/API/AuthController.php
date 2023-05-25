<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|between:2,100',
			'email' => 'required|string|email|max:100|unique:users',
			'password' => 'required|string|min:6',
			'c_password' => 'required|same:password',
		]);

		if ($validator->fails()) {

			if ($validator->errors()->has('email')) {
				if (User::where('email', $request->email)->first()) {
					return response()->json([
						'success' => false,
						'message' => 'Cet email est déjà utilisé',
					], 200);
				}

				return response()->json([
					'success' => false,
					'message' => 'L\'email n\'est pas valide',
				], 200);
			}

			if ($validator->errors()->has('password')) {
				return response()->json([
					'success' => false,
					'message' => 'Le mot de passe doit contenir au moins 6 caractères',
				], 200);
			}

			if ($validator->errors()->has('c_password')) {
				return response()->json([
					'success' => false,
					'message' => 'Les mots de passe ne correspondent pas',
				], 200);
			}

			if($validator->errors()->has('name')) {
				return response()->json([
					'success' => false,
					'message' => 'Le nom est requis',
				], 200);
			}

			return response()->json([
				'success' => false,
				'message' => 'Une erreur est survenue',
			], 200);

		}

		$inputs = $request->all();
		$inputs['password'] = bcrypt($inputs['password']);
		$user = User::create($inputs);

		$token = $user->createToken('MyApp')->plainTextToken;

		return response()->json([
			'success' => true,
			'message' => 'Utilisateur enregistré',
			'user' => $user,
			'token' => $token
		], 200);
	}

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
