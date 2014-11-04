<?php

class AdminController extends BaseController {


	public function index(){
		return Redirect::route('admin_productos')
			->with('module', 'productos')
			->with('title', 'Productos');
	}

	public function productos(){
		$productos = Producto::paginate(20);
		return View::make('admin.producto.index')
			->with('module', 'productos')
			->with('title', 'Productos')
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
		
		if(Input::hasFile('imagen')){
			$producto = Producto::findOrFail($id);
			
			$file = Input::file('imagen');
			$imagen = $producto->id.'.'.$file->getClientOriginalExtension();
			$imagen_thumb = 'thumb_'.$producto->id.'.'.$file->getClientOriginalExtension();
			$imagen_mini = 'venta_'.$producto->id.'.'.$file->getClientOriginalExtension();
			$directorio = public_path().'/img/productos/';
			//verifica la imagen y la elimina
			if(File::exists($directorio.$producto->imagen)){
				File::delete($directorio.$producto->imagen);
			}
			//verifica la imagen thumbnail y la elimina
			if(File::exists($directorio.'thumb_'.$producto->imagen)){
				File::delete($directorio.'thumb_'.$producto->imagen);
			}
			//verifica la imagen mini y la elimina
			if(File::exists($directorio.'venta_'.$producto->imagen)){
				File::delete($directorio.'venta_'.$producto->imagen);
			}
			
			//guarda la imagen - administracion, venta - individual
			$image = Image::make($file);
			$image->fit(420, 520);
			$image->save($directorio.$imagen);
			//thumbnail - administracion
			//$image = Image::make($file);
			$image->fit(180, 140);
			$image->save($directorio.$imagen_thumb);
			//venta - pagina principal
			//$image = Image::make($file);
			$image->fit(250, 188);
			$image->save($directorio.$imagen_mini);
			
			//setea la iamgen al usuario
			$producto->imagen = $imagen;
			$producto->save();
		}
		
		return Redirect::route('admin_producto_consultar', $producto->id)
			->with('module', 'productos')
			->with('title', 'Producto');
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

	public function ajustes(){
		return View::make('admin.ajustes')
			->with('module', 'ajustes')
			->with('title', 'Ajustes');
	}

}
