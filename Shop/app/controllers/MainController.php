<?php

class MainController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function principal()
	{
		return View::make('producto.index')
			->with('title', 'Productos');
	}

	public function login()
	{
		return View::make('layouts.login')
			->with('title', 'Login');
	}

}
