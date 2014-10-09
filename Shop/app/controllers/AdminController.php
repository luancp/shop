<?php

class AdminController extends BaseController {


	public function index()
	{
		return View::make('admin.producto.index')
			->with('title', 'Productos');
	}

}
