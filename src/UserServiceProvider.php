<?php

namespace Wooturk;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class UserServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Route::get('/users', [UserController::class, 'list']);
		Route::get('/user', [UserController::class, 'index']);
		Route::get('/user/{id}', [UserController::class, 'get']);
		Route::group(['middleware' => ['auth:sanctum']], function(){
			Route::post('/user', [UserController::class, 'post']);
			Route::put('/user/{id}', [UserController::class, 'put']);
			Route::delete('/user/{id}', [UserController::class, 'delete']);
		});
	}
}
