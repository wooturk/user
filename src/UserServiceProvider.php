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
		Route::get('/user', [UserController::class, 'index'])->name('user-index');
		Route::post('/user', [UserController::class, 'post'])->name('user-create');
		Route::group(['middleware' => ['auth:sanctum','wooturk.gateway','wooturk.gateway']], function(){
			Route::get('/users', [UserController::class, 'list'])->name('user-list');
			Route::get('/user/{id}', [UserController::class, 'get'])->name('user-get');
			Route::put('/user/{id}', [UserController::class, 'put'])->name('user-put');
			Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user-delete');
		});
	}
}
