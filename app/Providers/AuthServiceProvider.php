<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

		$this->app['auth']->viaRequest('api', function (Request $request) {
			if (!$request->hasHeader('Authorization')) {
				return null;
			}

			$auth_header = $request->header('Authorization');
			$token = str_replace('Bearer ', '', $auth_header);

			$jwt_key = new Key(env('JWT_KEY'), 'HS256');
			$auth_data = JWT::decode($token, $jwt_key);

			return User::where('email', $auth_data->email)->first();
		});
    }
}
