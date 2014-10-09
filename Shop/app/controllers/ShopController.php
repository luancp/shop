<?php

class ShopController extends BaseController {

	//pagina principal
	public function principal()
	{
		return View::make('shop.index')
			->with('title', 'Login');
	}
	
	//pagina para el login
	public function showLogin()
	{
		return View::make('layouts.login')
			->with('title', 'Login');
	}
	
	//post - login del usuario	
	public function login() {
        $usuario = array('usuario' => Input::get('usuario'), 'password' => Input::get('password'));
        if(Auth::attempt($usuario)){
            $usuario = Auth::user();
			Session::put('usuario', $usuario);
            return Redirect::route('principal');
        }else{
            Session::flash('error_login','Usuario o clave incorrectos.');	
            return Redirect::to('login')
                    ->withInput(Input::except('password'));
        }
    }
    
    // metodo para el logout del usuario
	public function logout(){
		Auth::logout();
		Session::flush();
		Cache::flush();
		return Redirect::to('/');
	}
	
	// --------------------------------------------------------------
	//para cuando se muestra el carrito
	public function carrito()
	{
		return View::make('shop.carrito.index')
			->with('title', 'Carrito de Compras');
	}

	//para mostrar el perfil del usuario
	public function mostrarPerfil()
	{
		$usuario = Auth::user();
		return View::make('shop.perfil')
			->with('title', 'Perfil de Usuario')
			->with('usuario', $usuario);
	}

}
