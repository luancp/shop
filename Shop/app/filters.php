<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	if(!Session::has('empresa')){
		$empresa = Empresa::find(1);
		Session::put('empresa', $empresa);
		Session::put('empresa_id', $empresa->id);
	}
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if(!Auth::check()){
		Session::put('url.intended', Request::path());
		return Redirect::route('login');
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('admin', function()
{
	if(Auth::check()){
		if(!Session::has('usuario') || !Session::get('usuario')->es_admin){
			Session::flash('error_mensaje', 'No tiene autorización para ingresar a este menu.');
			return Redirect::route('principal');
		}
	}else{
		return Redirect::route('principal');
	}
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
