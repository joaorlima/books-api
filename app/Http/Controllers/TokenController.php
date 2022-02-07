<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller {

	public function create(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required',
		]);

		$user = User::where('email', $request->email)->first();

		if (null === $user) {
			return response()->json('Invalid data', Response::HTTP_UNAUTHORIZED);
		}

		$password_matches = Hash::check($request->password, $user->password);

		if (!$password_matches) {
			return response()->json('', Response::HTTP_UNAUTHORIZED);
		}

		$token = JWT::encode(
			['email' => $request->email],
			env('JWT_KEY'),
			'HS256'
		);

		return [
			'access_token' => $token,
		];
	}

}
