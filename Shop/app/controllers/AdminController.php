<?php

class AdminController extends BaseController {


	public function index(){
		return Redirect::route('admin_productos')
			->with('module', 'productos')
			->with('title', 'Productos');
	}

	public function productos(){
		$productos = Producto::paginate(20);
		return View::make('admin.productos')
			->with('module', 'productos')
			->with('title', 'Productos')
			->with('productos', $productos);
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
			Session::flash('error_mensaje', 'Se ha producido un error de conexion.');
		}
		return Redirect::route('admin_productos')
			->with('module', 'productos')
			->with('title', 'Productos')
			->with('productos', "asdjashdjashdjhasjdhajsdhasjdhjashdja");
	}

	public function categorias(){
		$categorias = Categoria::paginate(30);
		return View::make('admin.categorias')
			->with('module', 'categorias')
			->with('title', 'Categorias')
			->with('categorias', $categorias);
	}

	public function usuarios(){
		return View::make('admin.usuarios')
			->with('module', 'usuarios')
			->with('title', 'Usuarios');
	}

	public function ajustes(){
		return View::make('admin.ajustes')
			->with('module', 'ajustes')
			->with('title', 'Ajustes');
	}

}
