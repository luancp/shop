<?php

class AdminController extends BaseController {


	public function index()
	{
		return View::make('admin.index')
			->with('module', 'productos')
			->with('title', 'Productos');
	}

	public function productos()
	{
		return View::make('admin.productos')
			->with('module', 'productos')
			->with('title', 'Productos');
	}

	public function categorias()
	{
		return View::make('admin.categorias')
			->with('module', 'categorias')
			->with('title', 'Categorias');
	}

	public function usuarios()
	{
		return View::make('admin.usuarios')
			->with('module', 'usuarios')
			->with('title', 'Usuarios');
	}

	public function ajustes()
	{
		return View::make('admin.ajustes')
			->with('module', 'ajustes')
			->with('title', 'Ajustes');
	}

}
