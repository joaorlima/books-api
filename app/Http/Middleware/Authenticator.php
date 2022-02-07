<?php

namespace App\Http\Middleware;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticator {

	public function handle(Request $request, \Closure $next) {
		try {
			if (!$request->hasHeader('Authorization')) {
				throw new \Exception();
			}

			$auth_header = $request->header('Authorization');
			$token = str_replace('Bearer ', '', $auth_header);
			$jwt_key = new Key(env('JWT_KEY'), 'HS256');
			$auth_data = JWT::decode($token, $jwt_key);

			$user = User::where('email', $auth_data->email)->first();

			if (null === $user) {
				throw new \Exception();
			}
		} catch (\Exception $_) {
			return response()->json('Unauthorized', Response::HTTP_UNAUTHORIZED);
		}

		return $next($request);
	}

}
