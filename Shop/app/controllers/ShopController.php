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
	public function carrito()
	{
		return View::make('shop.carrito.index')
			->with('title', 'Carrito de Compras');
	}



}
