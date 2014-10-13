<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'principal', 'uses' => 'ShopController@principal'));
Route::get('login/', array('as' => 'login', 'uses' => 'MainController@showLogin'));
Route::post('login_user/', array('as' => 'login_user', 'uses' => 'MainController@login'));
Route::get('logout/', array('as' => 'logout', 'uses' => 'MainController@logout'));

//registro de usuarios
Route::get('registro/', array('as' => 'registrar', 'uses' => 'ShopController@showRegistro'));
Route::post('registro_usuario/', array('as' => 'usuario_registrar', 'uses' => 'ShopController@registrar'));

//urls con seguridad - para la tienda
Route::group(array('before' => 'auth'), function(){
	//para el carrito de compras
	Route::get('carrito/', array('as' => 'carrito', 'uses' => 'ShopController@carrito'));

	//para las paginas del perfil
	Route::get('perfil/', array('as' => 'perfil', 'uses' => 'AjustesController@mostrarPerfil'));
	Route::post('perfil/update/', array('as' => 'perfil_actualizar', 'uses' => 'AjustesController@actualizarPerfil'));
	//para las paginas de cuenta	
	Route::get('cuenta/', array('as' => 'cuenta', 'uses' => 'AjustesController@mostrarCuenta'));
	Route::get('cuenta/update/', array('as' => 'cuenta_actualizar', 'uses' => 'AjustesController@actualizarCuenta'));
	//para las paginas de contrasenia	
	Route::get('password/', array('as' => 'contrasenia', 'uses' => 'AjustesController@mostrarContrasenia'));
	Route::get('password/update/', array('as' => 'contrasenia_actualizar', 'uses' => 'AjustesController@actualizarContrasenia'));
});

//urls con seguridad - para el admin
Route::group(array('before' => 'auth|admin'), function(){
	//para el admin
	Route::get('admin/', array('as' => 'admin', 'uses' => 'AdminController@index'));
	Route::get('admin/productos/', array('as' => 'productos', 'uses' => 'AdminController@productos'));
	Route::get('admin/categorias/', array('as' => 'categorias', 'uses' => 'AdminController@categorias'));
	Route::get('admin/usuarios/', array('as' => 'usuarios', 'uses' => 'AdminController@usuarios'));
	Route::get('admin/ajustes/', array('as' => 'ajustes', 'uses' => 'AdminController@ajustes'));
	
});

