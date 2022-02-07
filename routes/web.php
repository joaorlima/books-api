<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router): void {
	$router->group(['prefix' => 'book'], function () use ($router): void {
		$router->get('', 'BookController@index');
		$router->post('', 'BookController@store');
		$router->get('{id}', 'BookController@show');
		$router->put('{id}', 'BookController@update');
		$router->delete('{id}', 'BookController@destroy');
		$router->get('{book_id}/review', 'BookReviewController@getPerBook');
	});
	$router->group(['prefix' => 'review'], function () use ($router): void {
		$router->post('', 'BookReviewController@store');
		$router->get('{id}', 'BookReviewController@show');
		$router->put('{id}', 'BookReviewController@update');
		$router->delete('{id}', 'BookReviewController@destroy');
	});
});

$router->post('/api/login', 'TokenController@create');
