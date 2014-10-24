<?php

class ShopController extends BaseController {

	//pagina principal de la tienda
	public function principal()
	{
		$id = '';
		$categorias = Categoria::all();
		if(Request::has('categoria')){
			$productos = Producto::where('categoria_id', Input::get('categoria'))->get();
			if($productos->count() > 0){
				$id = Input::get('categoria');
			}else{
				$productos = Producto::all();
				$id = '-1';
			}
		}else{
			$productos = Producto::all();
			$id = '-1';
		}
		return View::make('shop.index')
			->with('title', 'Principal')
			->with('cat', $id)
			->with('categorias', $categorias)
			->with('productos', $productos);
	}
	
	//para cuando se muestra el carrito
	public function showProducto($id)
	{
		$producto = Producto::findOrFail($id);
		$categorias = Categoria::all();
		return View::make('shop.producto')
			->with('producto', $producto)
			->with('categorias', $categorias)
			->with('cat', '')
			->with('title', 'Carrito de Compras');
	}

	//para cuando se muestra el carrito
	public function carrito()
	{
		return View::make('shop.carrito.index')
			->with('title', 'Carrito de Compras');
	}
	
	//agregar los productos al carrito de compras
	public function agregarCarrito(){
		$id = Input::get('id');
		$cantidad = Input::get('cantidad');
		$carrito = Cookie::get('carrito');
		$cookie_compras = null;
		$cookie_cantidad = null;
		//$carrito_cantidad = Cookie::get('carrito_cantidad');
		if(!is_null($carrito)){
			if(array_key_exists($id,$carrito)){
				$cant = (int)$carrito[$id]+(int)$cantidad;
				array_set($carrito, $id, (int)$cant);
				$cookie_compras = Cookie::forever('carrito', $carrito);
			}else{
				$carrito = array_add($carrito, $id, $cantidad);
				$cookie_compras = Cookie::forever('carrito', $carrito);
			}
			$cookie_cantidad = Cookie::forever('carrito_cantidad', count($carrito));
		}else{
			$carrito = array();
			$compras = array_add($carrito, $id, (int)$cantidad);
			$cookie_compras = Cookie::forever('carrito', $compras);
			$cookie_cantidad = Cookie::forever('carrito_cantidad', count($compras));
		}
		//redireccion despues de agregar al carrito
		//dd($carrito);
		return Redirect::route('principal')
			->withCookie($cookie_compras)
			->withCookie($cookie_cantidad);
	}



}
