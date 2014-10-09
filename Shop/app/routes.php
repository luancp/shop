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
Route::get('login/', array('as' => 'login', 'uses' => 'ShopController@showLogin'));
Route::post('login_user/', array('as' => 'login_user', 'uses' => 'ShopController@login'));
Route::get('logout/', array('as' => 'logout', 'uses' => 'ShopController@logout'));

//registro de usuarios
Route::get('registro/', array('as' => 'registrar', 'uses' => 'ShopController@showRegistro'));
Route::post('registro_usuario/', array('as' => 'usuario_registrar', 'uses' => 'ShopController@registrar'));

//urls con seguridad - para la tienda
Route::group(array('before' => 'auth'), function(){
	//para el carrito de compras
	Route::get('carrito/', array('as' => 'carrito', 'uses' => 'ShopController@carrito'));
	
	//para las paginas del perfil
	Route::get('perfil/', array('as' => 'perfil', 'uses' => 'ShopController@mostrarPerfil'));
	Route::post('perfil/update/', array('as' => 'perfil_update', 'uses' => 'ShopController@actualizarPerfil'));
});

//urls con seguridad
Route::group(array('before' => 'auth|admin'), function(){
	//para el admin
	Route::get('admin/', array('as' => 'admin', 'uses' => 'AdminController@index'));
	Route::get('admin/productos/', array('as' => 'admin_productos', 'uses' => 'AdminController@productos'));
});

