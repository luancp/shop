<?php

class MainController extends BaseController {

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
			//setea la imagen del usuario
			if($usuario->imagen){
				$imagen = $usuario->imagen;
			}else{
				$imagen = 'default.png';
			}
			Session::put('imagen_usuario', URL::asset('/img/avatars/'.$imagen));
			//seteo los productos de su wishlist
			$lista = $usuario->wishlists();
			Session::put('wishlist', $lista->get());
			
			$empresa = Empresa::find(1);
			Session::put('empresa_id', $empresa->id);
			Session::put('empresa', $empresa);
			return Redirect::intended('/');
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
	

}
