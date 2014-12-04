<?php

class ShopController extends BaseController {

	//pagina principal de la tienda
	public function principal(){
		$id = '';
		$paginacion = 39;
		$categorias = Categoria::whereNull('padre_id')->orderBy('nombre', 'asc')->get();
		
		if(Request::isMethod('get')){
			if(Request::has('categoria')){
				$productos = Producto::where('categoria_id', Input::get('categoria'))->paginate($paginacion);
				if($productos->count() > 0){
					$id = Input::get('categoria');
				}else{
					$productos = Producto::paginate($paginacion);
					$id = '-1';
				}
			}else{
				if(Input::has('curso')){
					//solo las categorias del curso
					//$categorias = Categoria::whereNull('padre_id')->where('')->orderBy('nombre', 'asc')->get();
					
					$colegio = Colegio::find(Input::get('colegio'));
					$curso = Curso::find(Input::get('curso'));
					$productos = $curso->productos()->paginate($paginacion);
					Session::put('colegio', $colegio->nombre);
					Session::put('curso', $curso->nombre);
					$id = '-1';
					return View::make('shop.consultar')
						->with('title', 'Principal')
						->with('cat', $id)
						->with('categorias', $categorias)
						->with('productos', $productos);
				}else{
					$productos = Producto::paginate($paginacion);
					$id = '-1';
					Session::set('colegio', null);
					Session::set('curso', null);
				}
			}
			
		}
		$productos = $productos->appends(Input::except('page'));
		return View::make('shop.index')
			->with('title', 'Principal')
			->with('cat', $id)
			->with('categorias', $categorias)
			->with('productos', $productos);
	}
	
	//para cuando se muestra el carrito
	public function showProducto($id){
		$producto = Producto::findOrFail($id);
		$categorias = Categoria::all();
		return View::make('shop.producto')
			->with('producto', $producto)
			->with('categorias', $categorias)
			->with('cat', '')
			->with('title', 'Carrito de Compras');
	}
	
	//para cuando se muestra el carrito
	public function carrito(){
		$total = 0.00;
		$iva = 0.00;
		$gran_total = 0.00;
		$compras = Cookie::get('carrito');
		if(is_null($compras)){
			$compras = array();
		}else{
			foreach($compras as $c){
				$total = $total + (array_get($c, 'precio')*array_get($c, 'cantidad'));
			}
			$iva = ($total*0.12);
			$gran_total = $iva + $total;
		}
		
		return View::make('shop.carrito.index')
			->with('compras', $compras)
			->with('items', count($compras))
			->with('total', $total)
			->with('iva', $iva)
			->with('gran_total', $gran_total)
			->with('title', 'Carrito de Compras');
	}
	
	//agregar los productos al carrito de compras
	public function agregarCarrito(){
		$id = Input::get('id');
		$cantidad = Input::get('cantidad');
		$nombre = Input::get('nombre');
		$precio = Input::get('precio');
		$imagen = Input::get('imagen')?Input::get('imagen'):null;
		$carrito = Cookie::get('carrito');
		$cookie_compras = null;
		$cookie_cantidad = null;
		//$carrito_cantidad = Cookie::get('carrito_cantidad');
		if((int)$cantidad <= 0){
			$cantidad = 1;
		}
		if(!is_null($carrito) && count($carrito) > 0){
			foreach($carrito as $c){
				$item_id = (int)array_get($c, 'id');
				if($item_id == (int)$id){
					$cant = (int)array_get($c, 'cantidad')+(int)$cantidad;
					$item = array('id'=>$id, 'cantidad'=>(int)$cant, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
					$carrito = array_set($carrito, $id, $item);
					$cookie_compras = Cookie::forever('carrito', $carrito);
					$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
					break;
				}else{
					$item = array('id'=>$id, 'cantidad'=>(int)$cantidad, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
					$carrito = array_add($carrito, $id, $item);
					$cookie_compras = Cookie::forever('carrito', $carrito);
					$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
				}
			}
		}else{
			$carrito = array();
			$item = array('id'=>$id, 'cantidad'=>(int)$cantidad, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
			$carrito = array_add($carrito, $id, $item);
			$cookie_compras = Cookie::forever('carrito', $carrito);
			$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
		}
		//redireccion despues de agregar al carrito
		return Redirect::route('carrito')
			->withCookie($cookie_compras)
			->withCookie($cookie_cantidad);
	}
	
	//muestra los productos del wishlist 
	public function mostrarWishlist(){
		//consulta lo que tiene en su lista actual
		$usuario = Session::get('usuario');
		if(!Session::has('wishlist')){
			$lista = $usuario->wishlists();
			Session::put('wishlist', $lista->get());
		}else{
			$lista = $usuario->wishlists();
		}

		return View::make('shop.wishlist.index')
			->with('lista', $lista->get())
			->with('items', count($lista))
			->with('title', 'WishList');
	}
	
	//agregar los productos a wishlist
	public function agregarWishlist(){
		$producto_id = Input::get('producto_id');
		//consulta lo que tiene en su lista actual
		$usuario = Session::get('usuario');
		$wishlist = Session::get('wishlist');
		if(!isset($wishlist)){
			$wishlist = $usuario->wishlists();
			Session::put('wishlist', $wishlist->get());
		}
		//verifica si existe el pproduto en la lista
		if(!Wishlist::existeProducto($usuario->id, $producto_id)){
			$w = new Wishlist;
			$w->usuario_id = $usuario->id;
			$w->producto_id = $producto_id;
			$w->cantidad = 1;
			$w->save();
		}
		$wishlist = $usuario->wishlists();
		Session::put('wishlist', $wishlist->get());

		return Redirect::route('mostrar_wishlist')
			->with('lista', $wishlist->get());
	}

	//elimina los productos a wishlist
	public function wishlistEliminarProducto(){
		$usuario = Session::get('usuario');
		$id_prod = Input::get('id_prod');
		
		$wl = Wishlist::find($id_prod);
		if($wl){
			$wl->delete();
		}
				
		$wishlist = $usuario->wishlists();
		Session::put('wishlist', $wishlist->get());
		return Redirect::route('mostrar_wishlist')
			->with('lista', $wishlist->get());
	}

	//mueve el producto de wishlist al carrito
	public function wishlistMoverProducto(){
		$usuario = Session::get('usuario');
		$id_wish = Input::get('id_wish');
		
		//agrega el producto al carrito y lo elimina del wishlist
		$id = Input::get('id');
		$cantidad = 1;
		$nombre = Input::get('prod_nombre');
		$precio = Input::get('prod_precio');
		$imagen = Input::get('prod_imagen')?Input::get('prod_imagen'):null;
		$carrito = Cookie::get('carrito');
		$cookie_compras = null;
		$cookie_cantidad = null;
		
		if(!is_null($carrito) && count($carrito) > 0){
			foreach($carrito as $c){
				$item_id = (int)array_get($c, 'id');
				if($item_id == (int)$id){
					$cant = (int)array_get($c, 'cantidad')+(int)$cantidad;
					$item = array('id'=>$id, 'cantidad'=>(int)$cant, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
					$carrito = array_set($carrito, $id, $item);
					$cookie_compras = Cookie::forever('carrito', $carrito);
					$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
					break;
				}else{
					$item = array('id'=>$id, 'cantidad'=>(int)$cantidad, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
					$carrito = array_add($carrito, $id, $item);
					$cookie_compras = Cookie::forever('carrito', $carrito);
					$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
				}
			}
		}else{
			$carrito = array();
			$item = array('id'=>$id, 'cantidad'=>(int)$cantidad, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
			$carrito = array_add($carrito, $id, $item);
			$cookie_compras = Cookie::forever('carrito', $carrito);
			$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
		}
		//se elimina del wishlist despues de agregado al carrito
		$wl = Wishlist::find($id_wish);
		if($wl){
			$wl->delete();
		}
				
		$wishlist = $usuario->wishlists();
		Session::put('wishlist', $wishlist->get());		
		
		return Redirect::route('carrito')
			->withCookie($cookie_compras)
			->withCookie($cookie_cantidad);
	}

	//para cuando se actualiza la cantidad de un producto del carrito
	public function carritoActualizarProducto(){
		$compras = Cookie::get('carrito');
		$id_prod = Input::get('id_prod');
		$cantidad = (int)Input::get('cantidad');
		if(is_null($compras)){
			$compras = array();				
		}else{
			if($cantidad > 0){
				foreach($compras as $c){
					$item_id = (int)array_get($c, 'id');
					if($item_id == (int)$id_prod){
						$nombre = array_get($c, 'nombre');
						$precio = array_get($c, 'precio');
						$imagen = array_get($c, 'imagen');
						$item = array('id'=>$id_prod, 'cantidad'=>(int)$cantidad, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
						$compras = array_set($compras, $id_prod, $item);
						//$cookie_compras = Cookie::forever('carrito', $carrito);
						//$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
						break;
					}
				}
			}
		}
		$cookie_compras = Cookie::forever('carrito', $compras);
		$cookie_cantidad = Cookie::forever('carrito_cantidad', count($compras));
		return Redirect::route('carrito')
		->withCookie($cookie_compras)
		->withCookie($cookie_cantidad);
	}
	//para cuando se elimina un producto del carrito
	public function carritoEliminarProducto(){
		$compras = Cookie::get('carrito');
		$id_prod = Input::get('id_prod');
		if(is_null($compras)){
			$compras = array();			
		}else{
			$comp = array_pull($compras, $id_prod);
		}
		$cookie_compras = Cookie::forever('carrito', $compras);
		$cookie_cantidad = Cookie::forever('carrito_cantidad', count($compras));
		return Redirect::route('carrito')
			->withCookie($cookie_compras)
			->withCookie($cookie_cantidad);
	}

	//obtiene todos los colegios para la pagina principal
	public function getColegios(){
		$empresa = Session::get('empresa');
		$colegios = Colegio::where('empresa_id', $empresa->id)->select(array('id', 'nombre'))->get();
		return Response::json($colegios);
	}

	//obtiene todos los cursos dado el colegio
	public function getCursos(){
		$cursos = Curso::where('colegio_id', Input::get('colegio_id'))->select(array('id', 'nombre'))->get();
		return Response::json($cursos);
	}
	
	//retorna el total del curso seleccionado
	public function getCursoTotal(){
		$lista = CursoLista::where('curso_id', Input::get('curso_id'))->get();
		$total = 0;
		foreach($lista as $l){
			$p = Producto::find($l->producto_id);
			$total = $total + $p->precio;
		}
		return Response::json(array('total' => number_format($total, 2)));
	}
	
	//agrega todos los productos del curso en el carrito
	public function agregarCarritoTodosLista(){
		$lista = CursoLista::where('curso_id', Input::get('curso'))->get();
		if($lista->count() > 0){
			try{
				$carrito = Cookie::get('carrito');
				foreach($lista as $l){
					$id = $l->producto->id;
					$cantidad = $l->cantidad;
					$nombre = $l->producto->nombre;
					$precio = $l->producto->precio;
					$imagen = $l->producto->imagen?$l->producto->imagen:null;
					$cookie_compras = null;
					$cookie_cantidad = null;
					//$carrito_cantidad = Cookie::get('carrito_cantidad');
					if((int)$cantidad <= 0){
						$cantidad = 1;
					}
					if(!is_null($carrito) && count($carrito) > 0){
						foreach($carrito as $c){
							$item_id = (int)array_get($c, 'id');
							if($item_id == (int)$id){
								$cant = (int)array_get($c, 'cantidad')+(int)$cantidad;
								$item = array('id'=>$id, 'cantidad'=>(int)$cant, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
								$carrito = array_set($carrito, $id, $item);
								$cookie_compras = Cookie::forever('carrito', $carrito);
								$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
								//break;
							}else{
								$item = array('id'=>$id, 'cantidad'=>(int)$cantidad, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
								$carrito = array_add($carrito, $id, $item);
								$cookie_compras = Cookie::forever('carrito', $carrito);
								$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
							}
						}
					}else{
						$carrito = array();
						$item = array('id'=>$id, 'cantidad'=>(int)$cantidad, 'nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen);
						$carrito = array_add($carrito, $id, $item);
						$cookie_compras = Cookie::forever('carrito', $carrito);
						$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
					}
				}
				//redireccion despues de agregar al carrito
				return Redirect::route('carrito')
					->withCookie($cookie_compras)
					->withCookie($cookie_cantidad);
			}catch(Exception $e){
				Log::info($e);
			}
		}
		return Redirect::route('carrito');
	}

		
	//para cuando se muestra el carrito
	public function mostrarOrdenes(){
		
		return View::make('ordenes.index')
			->with('title', 'Ordenes de Compras');
	}
		
	//para cuando se muestra el carrito
	public function carritoComprar(){
		$carrito = Cookie::get('carrito');
		return View::make('ordenes.index')
			->with('title', 'Ordenes de Compras');
	}
}
