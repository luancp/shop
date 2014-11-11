<?php

class AdminController extends BaseController {


	public function index(){
		return Redirect::route('admin_productos')
			->with('module', 'productos')
			->with('title', 'Productos');
	}

	public function productos(){
		$empresa = Empresa::find(Session::get('empresa_id'));
		$productos = Producto::paginate(20);
		return View::make('admin.producto.index')
			->with('module', 'productos')
			->with('title', 'Productos')
			->with('empresa', $empresa)
			->with('productos', $productos);
	}

	public function productoConsultar($id){
		$producto = Producto::findOrFail($id);
		return View::make('admin.producto.consultar')
			->with('module', 'productos')
			->with('title', 'Producto')
			->with('producto', $producto);
	}
	
	public function productoActualizar(){
		$id = Input::get('id');
		
		$producto = Producto::findOrFail($id);
		if(Input::hasFile('imagen')){
			
			$file = Input::file('imagen');
			$coors = Input::get('img-coors');
			
			$imagen = $producto->id.'.'.$file->getClientOriginalExtension();
			$imagen_thumb = 'thumb_'.$producto->id.'.'.$file->getClientOriginalExtension();
			//$imagen_mini = 'venta_'.$producto->id.'.'.$file->getClientOriginalExtension();
			$directorio = public_path().'/img/productos/';
			
			//verifica la imagen y la elimina
			if(File::exists($directorio.$producto->imagen)){
				File::delete($directorio.$producto->imagen);
			}
			//verifica la imagen thumbnail y la elimina
			if(File::exists($directorio.'thumb_'.$producto->imagen)){
				File::delete($directorio.'thumb_'.$producto->imagen);
			}
			
			//verifica las coordenadas de la imagen
			$image = Image::make($file);
			if(!$coors){
				//imagen para producto - individual
				$width = $image->width();
				$height = $image->height();
				if($height < 500){
					$image->resizeCanvas(null, 500, 'center', false, 'ffffff');
				}
				if($width < 420){
					$image->resizeCanvas(420, null, 'center', false, 'ffffff');
				}
				$image->fit(420, 500);
			}else{
				$cor = json_decode($coors);
				//imagen para producto - individual
				$image = $image->crop((int)$cor->w, (int)$cor->h, (int)$cor->x, (int)$cor->y);
			}
			$image->save($directorio.$imagen);
			
			//thumbnail - administracion y carrito
			$image = Image::make($directorio.$imagen);
			$image->fit(180, 140);
			$image->save($directorio.$imagen_thumb);
			
			//setea la imagen al producto
			$producto->imagen = $imagen;
			$producto->save();
		}
		
		return Redirect::route('admin_producto_consultar', $producto->id)
			->with('module', 'productos')
			->with('title', 'Producto');
	}

	//sube la imagen al servidor
	public function prodImagenSubir($id){
		$producto = Producto::findOrFail(Input::get('id'));
		$file = Input::file('img');
		
		$imagen = $id.'.'.$file->getClientOriginalExtension();
		$directorio = public_path().'/img/productos/';
		
		//verifica y elimina las imagenes anteriores
		if(File::exists($directorio.$producto->imagen)){
			File::delete($directorio.$producto->imagen);
		}
		if(File::exists($directorio.'thumb_'.$producto->imagen)){
			File::delete($directorio.'thumb_'.$producto->imagen);
		}
		
		$image = Image::make($file);
		$width = $image->width();
		$height = $image->height();
		if($height < 500){
			$image = $image->resizeCanvas(null, 600, 'center', false, 'ffffff');
		}
		if($width < 420){
			$image = $image->resizeCanvas(520, null, 'center', false, 'ffffff');
		}
		$image->save($directorio.'tmp_'.$imagen);
		
		//setear la imagen al producto
		$producto->imagen = $imagen;
		$producto->save();
		
		//retornar el json
		return Response::json(array(
			"status" => "success",
			"url" => URL::asset('img/productos/tmp_'.$imagen),
			"width" => $image->width(),
			"height" => $image->height(),
		));
	}

	//corta la imagen del servidor
	public function prodImagenCortar($id){
		$producto = Producto::findOrFail(Input::get('id'));
		$x = (int)Input::get('imgX1');
		$y = (int)Input::get('imgY1');
		$w = (int)Input::get('cropW');
		$h = (int)Input::get('cropH');
		$w_r = (int)Input::get('imgW');
		$h_r = (int)Input::get('imgH');
		
		$directorio = public_path().'/img/productos/';
		$imagen = $producto->imagen;
		$imagen_thumb = 'thumb_'.$imagen;
		
		$image = Image::make($directorio.'tmp_'.$imagen);
		$image = $image->resize($w_r, $h_r);
		$image = $image->crop($w, $h, $x, $y);
		$image->save($directorio.$imagen);
		
		//verifica y elimina la imagen temporal y la pequeña
		if(File::exists($directorio.'tmp_'.$imagen)){
			File::delete($directorio.'tmp_'.$imagen);
		}
		if(File::exists($directorio.'thumb_'.$imagen)){
			File::delete($directorio.'thumb_'.$imagen);
		}
		
		//thumbnail - administracion y carrito
		$image = Image::make($directorio.$imagen);
		$image->fit(180, 140);
		$image->save($directorio.$imagen_thumb);
			
		//setear la imagen al producto
		$producto->imagen = $imagen;
		$producto->save();
		
		//retornar el json
		return Response::json(array(
			"status" => "success",
			"url" => URL::asset('img/productos/'.$producto->imagen),
		));
	}
	
	//sube la imagen del banner al servidor
	public function bannerImagenSubir($id){
		$empresa = Session::get('empresa');
		$file = Input::file('img');
	
		$imagen = $empresa->id.'_banner.'.$file->getClientOriginalExtension();
		$directorio = public_path().'/img/';
				
		$image = Image::make($file);
		$width = $image->width();
		$height = $image->height();
		if($height < 250){
			$image = $image->resizeCanvas(null, 300, 'center', false, 'ffffff');
		}
		if($width < 850){
			$image = $image->resizeCanvas(1200, null, 'center', false, 'ffffff');
		}
		$image->save($directorio.'tmp_'.$imagen);
		
		//setear la imagen al producto
		$empresa->imagen_banner = $imagen;
		$empresa->save();
		
		//retornar el json
		return Response::json(array(
			"status" => "success",
			"url" => URL::asset('img/tmp_'.$imagen),
			"width" => $image->width(),
			"height" => $image->height(),
		));
	}

	//corta la imagen del servidor para el banner
	public function bannerImagenCortar($id){
		$empresa = Session::get('empresa');
		$x = (int)Input::get('imgX1');
		$y = (int)Input::get('imgY1');
		$w = (int)Input::get('cropW');
		$h = (int)Input::get('cropH');
		$w_r = (int)Input::get('imgW');
		$h_r = (int)Input::get('imgH');
		
		$directorio = public_path().'/img/';
		$imagen = $empresa->imagen_banner;
		
		$image = Image::make($directorio.'tmp_'.$imagen);
		$image = $image->resize($w_r, $h_r);
		$image = $image->crop($w, $h, $x, $y);
		$image->save($directorio.$imagen);
		
		//verifica y elimina la imagen temporal
		if(File::exists($directorio.'tmp_'.$imagen)){
			File::delete($directorio.'tmp_'.$imagen);
		}		
		
		//setear la imagen a la empresa
		$empresa->imagen_banner = $imagen;
		$empresa->save();
		
		//retornar el json
		return Response::json(array(
			"status" => "success",
			"url" => URL::asset('img/'.$empresa->imagen_banner),
		));
	}
	
	//sube la imagen del popup modal al servidor
	public function popupImagenSubir($id){
		$empresa = Session::get('empresa');
		$file = Input::file('img');
		
		$imagen = $empresa->id.'_popup.'.$file->getClientOriginalExtension();
		$directorio = public_path().'/img/';
		
		//verifica y elimina las imagenes anteriores
		if(File::exists($directorio.$empresa->popup_imagen)){
			File::delete($directorio.$empresa->popup_imagen);
		}
		
		$image = Image::make($file);
		$width = $image->width();
		$height = $image->height();
		if($height < 500){
			$image = $image->resizeCanvas(null, 500, 'center', false, 'ffffff');
		}
		if($width < 500){
			$image = $image->resizeCanvas(500, null, 'center', false, 'ffffff');
		}
		$image = $image->encode('jpg', 75);
		$image->save($directorio.'tmp_'.$imagen);
		
		//setear la imagen al producto
		$empresa->popup_imagen = $imagen;
		$empresa->save();
		
		//retornar el json
		return Response::json(array(
			"status" => "success",
			"url" => URL::asset('img/tmp_'.$imagen),
			"width" => $image->width(),
			"height" => $image->height(),
		));
	}

	//corta la imagen del servidor para el banner
	public function popupImagenCortar($id){
		$empresa = Session::get('empresa');
		$x = (int)Input::get('imgX1');
		$y = (int)Input::get('imgY1');
		$w = (int)Input::get('cropW');
		$h = (int)Input::get('cropH');
		$w_r = (int)Input::get('imgW');
		$h_r = (int)Input::get('imgH');
		
		$directorio = public_path().'/img/';
		$imagen = $empresa->popup_imagen;
		
		$image = Image::make($directorio.'tmp_'.$imagen);
		$image = $image->resize($w_r, $h_r);
		$image = $image->crop($w, $h, $x, $y);
		$image->save($directorio.$imagen);
		
		//verifica y elimina la imagen temporal
		if(File::exists($directorio.'tmp_'.$imagen)){
			File::delete($directorio.'tmp_'.$imagen);
		}
		
		//setear la imagen a la empresa
		$empresa->popup_imagen = $imagen;
		$empresa->save();
		
		//retornar el json
		return Response::json(array(
			"status" => "success",
			"url" => URL::asset('img/'.$empresa->popup_imagen),
		));
	}
	
	public function sincronizacion(){
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://testcontifico.com:8000/api/producto/',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        'api_key' => 'PkSQJaidTstfiyPYsdGMhW50OQLrU40CDom7E02ptIU',
		        'api_token' => 'bd224dec-d59d-4595-9a89-4ecce9594993'
		    )
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources		
		curl_close($curl);
		
		if($resp){
			//procesar json
			Producto::procesar(json_decode($resp));
			Empresa::marcarSincronizacion(new DateTime('now', new DateTimeZone('America/Guayaquil')), Session::get('empresa_id'));
			Session::flash('success_mensaje', 'Se han importado los productos exitosamente.');
		}else{
			Session::flash('error_mensaje', 'Se ha producido un error de sincronizacion.');
		}
		return Redirect::route('admin_productos');
	}

	public function categorias(){
		$categorias = Categoria::paginate(30);
		return View::make('admin.categoria.index')
			->with('module', 'categorias')
			->with('title', 'Categorias')
			->with('categorias', $categorias);
	}

	//consulta todos los usuarios
	public function usuarios(){
		$usuarios = Usuario::paginate(30);
		return View::make('admin.usuario.index')
			->with('module', 'usuarios')
			->with('usuarios', $usuarios)
			->with('title', 'Usuarios');
	}

	//consulta un usuario
	public function usuarioConsultar($id){
		$usuario = Usuario::findOrFail($id);
		return View::make('admin.usuario.consultar')
			->with('module', 'usuarios')
			->with('usuario', $usuario)
			->with('title', 'Usuario');
	}

	//edita un usuario
	public function usuarioEditar($id){
		$usuario = Usuario::findOrFail($id);
		if(Request::isMethod('post')){
			
			Session::flash('success_mensaje', 'Se actualizo el usuario correctamente.');
		}
		return View::make('admin.usuario.editar')
			->with('module', 'usuarios')
			->with('usuario', $usuario)
			->with('title', 'Usuario');
	}

	//actualiza un usuario
	public function usuarioActualizar(){
		$id = Input::get('id');
		$usuario = Usuario::findOrFail($id);
		$rules = array(
            'nombres' => 'required|regex:/^[\pL\s]+$/u',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u',
            'cedula' => 'required|digits:10|unique:usuario_usuario,cedula,'.$usuario->id,
            'email' => 'required|email|unique:usuario_usuario,email,'.$usuario->id,
        );
        $validator = Validator::make(Input::all(), $rules);
        if(!$validator->fails()){
			$usuario->nombres = Input::get('nombres');
			$usuario->apellidos = Input::get('apellidos');
			$usuario->cedula = Input::get('cedula');
			$usuario->email = Input::get('email');
			$usuario->estado = Input::get('estado');
			$usuario->save();
			Session::flash('success_mensaje', 'Se actualizo el usuario correctamente.');
		}else{
			Session::flash('error_mensaje', 'Por favor corregir los campos con errores.');
			$response = Redirect::route('admin_usuario_editar', $usuario->id)
				->withErrors($validator)
				->with('messages', $validator->messages())
				->withInput();
			return $response;			
		}
		return Redirect::route('admin_usuario_editar', $usuario->id)
			->with('module', 'usuarios')
			->with('title', 'Usuario');
	}

	//muestra la ventana de ajustes de administracion
	public function ajustes(){
		$empresa = Session::get('empresa');
		return View::make('admin.ajustes')
			->with('module', 'ajustes')
			->with('empresa', $empresa)
			->with('title', 'Ajustes');
	}

	//cambia los ajustes del sistema
	public function actualizarAjustes(){
		$empresa = Session::get('empresa');
		if(Input::get('popup_activo')=='on'){
			$empresa->popup_activo = true;
			$empresa->popup_titulo = Input::get('popup_titulo');
		}else{
			$empresa->popup_activo = false;
		}
		if(Input::get('activa_facebook')=='on'){
			$empresa->facebook_plugin_activo = true;
			$empresa->facebook_plugin_script = Input::get('script_facebook');
		}else{
			$empresa->facebook_plugin_activo = false;
		}
		if(Input::get('activa_google')=='on'){
			$empresa->google_plugin_activo = true;
			$empresa->google_plugin_script = Input::get('script_google');
		}else{
			$empresa->google_plugin_activo = false;
		}
		
		$empresa->save();
		return Redirect::route('admin_ajustes')
			->with('module', 'ajustes')
			->with('title', 'Ajustes');
	}

	//pagina principal de colegios
	public function colegios(){
		$empresa = Session::get('empresa');
		$colegios = Colegio::where('empresa_id', $empresa->id)->get();
		return View::make('admin.colegio.index')
			->with('module', 'colegios')
			->with('title', 'Colegios');
	}
}
