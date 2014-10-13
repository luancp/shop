<?php

class ShopController extends BaseController {

	//pagina principal de la tienda
	public function principal()
	{
		return View::make('shop.index')
			->with('title', 'Principal');
	}
	
	//para cuando se muestra el carrito
	public function carrito()
	{
		return View::make('shop.carrito.index')
			->with('title', 'Carrito de Compras');
	}



}
