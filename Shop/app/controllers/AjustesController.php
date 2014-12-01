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
			Session::flash('error_mensaje', 'Por favor corregir los campos con errores.');
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

	//para actualizar la clave del usuario
	public function actualizarContrasenia()
	{
		$usuario = Auth::user();
		if(Request::isMethod('post')){			
			if(!Hash::check(Input::get('current_password'), $usuario->password)){
				Session::flash('error_mensaje', 'Las contraseña actual no coincide con la contraseña ingresada.');
				$response = Redirect::route('contrasenia')
					->withInput();
				return $response;
			}else{
				if(strlen(Input::get('new_password')) <= 5 && strlen(Input::get('confirm_password')) <= 5){
					Session::flash('error_mensaje', 'La nueva contraseña debe tener al menos 6 caracteres.');
					$response = Redirect::route('contrasenia')
						->withInput();
					return $response;
				}else{
					if(Input::get('new_password') != Input::get('confirm_password')){
						Session::flash('error_mensaje', 'La nueva contraseña debe coincidir con la contrseña de confirmación.');
						$response = Redirect::route('contrasenia')
							->withInput();
						return $response;
					}else{
						$usuario->password = Hash::make(Input::get('new_password'));
						$usuario->save();
						Session::flash('success_mensaje', 'Se ha realizado el cambio en su contraseña.');
					}
				}
			}
		}
		return View::make('ajustes.contrasenia')
			->with('title', 'Cambio de Contrase&ntilde;a')
			->with('module', 'contrasenia')
			->with('usuario', $usuario);
	}

}
