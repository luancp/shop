<?php

class AjustesController extends BaseController {

	//para mostrar el perfil del usuario
	public function mostrarPerfil()
	{
		$usuario = Auth::user();
		return View::make('ajustes.perfil')
			->with('title', 'Perfil de Usuario')
			->with('module', 'perfil')
			->with('usuario', $usuario);
	}
	
	//para actualizar el perfil del usuario
	public function actualizarPerfil()
	{
		// si actualiza la imagen, entonces se setea la sesion Session::put('imagen_usuario')
		$usuario = Auth::user();
		$validator = Usuario::validarPerfil(Input::all());
		if(!$validator->fails()){
			$usuario->nombres = Input::get('nombres');
			$usuario->apellidos = Input::get('apellidos');
			$usuario->cedula = Input::get('cedula');
			$usuario->genero = Input::get('genero');
			$usuario->ubicacion = Input::get('ubicacion');
			if(Input::hasFile('imagen')){
				$file = Input::file('imagen');
				$imagen = $usuario->usuario.'.'.$file->getClientOriginalExtension();
				$directorio = public_path().'/img/avatars/';
				//verifica la imagen
				if(File::exists($directorio.$usuario->imagen)){
					File::delete($directorio.$usuario->imagen);
				}
				
				//guarda la imagen
				$image = Image::make($file);
				$image->fit(140, 140);
				$image->save($directorio.$imagen);
				
				//setea la iamgen al usuario
				$usuario->imagen = $imagen;
				Session::put('imagen_usuario', URL::asset('/img/avatars/'.$imagen));
			}else{
				$usuario->imagen = '';
			}
			$usuario->save();
		}else{
			Session::flash('error_mensaje', 'Se ha producido un error.');
			$response = Redirect::route('perfil')
				->withErrors($validator)
				->with('messages', $validator->messages())
				->withInput();
			return $response;
		}		
		Session::flash('success_mensaje', 'Se han realizado los cambios en el perfil.');
		return Redirect::route('perfil')
			->with('title', 'Perfil de Usuario');
	}

	//para mostrar la cuenta del usuario
	public function mostrarCuenta()
	{
		$usuario = Auth::user();
		return View::make('ajustes.cuenta')
			->with('title', 'Cuenta de Usuario')
			->with('module', 'cuenta')
			->with('usuario', $usuario);
	}
	
	//para actualizar la cuenta del usuario
	public function actualizarCuenta()
	{
		$usuario = Auth::user();
		return View::make('ajustes.perfil')
			->with('title', 'Perfil de Usuario')
			->with('usuario', $usuario);
	}

	//para mostrar la clave del usuario
	public function mostrarContrasenia()
	{
		$usuario = Auth::user();
		return View::make('ajustes.contrasenia')
			->with('title', 'Cuenta de Usuario')
			->with('module', 'contrasenia')
			->with('usuario', $usuario);
	}
	
	//para actualizar la clave del usuario
	public function actualizarContrasenia()
	{
		$usuario = Auth::user();
		return View::make('ajustes.perfil')
			->with('title', 'Perfil de Usuario')
			->with('usuario', $usuario);
	}

}
