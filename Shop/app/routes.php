<?php

//para la autenticacion
Route::get('login/', array('as' => 'login', 'uses' => 'MainController@showLogin'));
Route::post('login_user/', array('as' => 'login_user', 'uses' => 'MainController@login'));
Route::get('logout/', array('as' => 'logout', 'uses' => 'MainController@logout'));

//para las paginas principales
Route::get('/', array('as' => 'principal', 'uses' => 'ShopController@principal'));
Route::get('/producto/{id}', array('as' => 'producto_venta', 'uses' => 'ShopController@showProducto'));

//para el carrito sin login - como Amazon.com
Route::post('/carrito/add/', array('as' => 'agregar_carrito', 'uses' => 'ShopController@agregarCarrito'));
Route::get('carrito/', array('as' => 'carrito', 'uses' => 'ShopController@carrito'));
Route::post('carrito/actualizar/', array('as' => 'carrito_actualizar_producto', 'uses' => 'ShopController@carritoActualizarProducto'));
Route::post('carrito/eliminar/', array('as' => 'carrito_eliminar_producto', 'uses' => 'ShopController@carritoEliminarProducto'));

//registro de usuarios
Route::get('registro/', array('as' => 'registrar', 'uses' => 'ShopController@showRegistro'));
Route::post('registro/usuario/', array('as' => 'usuario_registrar', 'uses' => 'ShopController@registrar'));

//resetear password
Route::get('password/reset/', array('as' => 'resetear_password', 'uses' => 'RemindersController@getRemind'));
Route::post('password/reset/', array('as' => 'resetear_password_post', 'uses' => 'RemindersController@postRemind'));
Route::get('password/reset/token/{token}', array('as' => 'resetear_password_token', 'uses' => 'RemindersController@getReset'));
Route::post('password/reset/token/', array('as' => 'resetear_password_token_post', 'uses' => 'RemindersController@postReset'));

//---------------------------------------------------------------------------------------------------------------
//urls con seguridad - para la tienda
Route::group(array('before' => 'auth'), function(){
	//para el carrito de compras
	Route::post('carrito/checkout/', array('as' => 'carrito_checkout', 'uses' => 'ShopController@carritoCheckout'));
	
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
//---------------------------------------------------------------------------------------------------------------
//urls con seguridad - para el admin
Route::group(array('before' => 'auth|admin'), function(){
	//para el admin
	Route::get('admin/', array('as' => 'admin', 'uses' => 'AdminController@index'));
	
	//productos
	Route::get('admin/productos/', array('as' => 'admin_productos', 'uses' => 'AdminController@productos'));
	Route::get('admin/producto/{id}', array('as' => 'admin_producto_consultar', 'uses' => 'AdminController@productoConsultar'));
	Route::post('admin/producto/', array('as' => 'admin_producto_actualizar', 'uses' => 'AdminController@productoActualizar'));
	Route::post('admin/producto/{id}', array('as' => 'admin_producto_subir', 'uses' => 'AdminController@prodImagenSubir'));
	Route::post('admin/producto/crop/{id}', array('as' => 'admin_producto_cortar', 'uses' => 'AdminController@prodImagenCortar'));
	Route::post('admin/productos/', array('as' => 'admin_sincronizacion', 'uses' => 'AdminController@sincronizacion'));
	
	//categorias
	Route::get('admin/categorias/', array('as' => 'admin_categorias', 'uses' => 'AdminController@categorias'));
	
	//usuarios
	Route::get('admin/usuarios/', array('as' => 'admin_usuarios', 'uses' => 'AdminController@usuarios'));
	Route::get('admin/usuarios/{id}', array('as' => 'admin_usuario_consultar', 'uses' => 'AdminController@usuarioConsultar'));
	Route::get('admin/usuarios/{id}/edit', array('as' => 'admin_usuario_editar', 'uses' => 'AdminController@usuarioEditar'));
	Route::post('admin/usuario/', array('as' => 'admin_usuario_actualizar', 'uses' => 'AdminController@usuarioActualizar'));
	
	//ajustes
	Route::get('admin/ajustes/', array('as' => 'admin_ajustes', 'uses' => 'AdminController@ajustes'));
	Route::post('admin/ajustes/update/', array('as' => 'admin_actualizar_ajustes', 'uses' => 'AdminController@actualizarAjustes'));
	//para las imagenes del banner principal
	Route::post('admin/ajustes/banner/{id}', array('as' => 'admin_banner_subir', 'uses' => 'AdminController@bannerImagenSubir'));
	Route::post('admin/ajustes/banner/crop/{id}', array('as' => 'admin_banner_cortar', 'uses' => 'AdminController@bannerImagenCortar'));
	//para las imagenes del popup modal
	Route::post('admin/ajustes/popup/{id}', array('as' => 'admin_popup_subir', 'uses' => 'AdminController@popupImagenSubir'));
	Route::post('admin/ajustes/popup/crop/{id}', array('as' => 'admin_popup_cortar', 'uses' => 'AdminController@popupImagenCortar'));
	
	//colegios
	Route::get('admin/colegios/', array('as' => 'admin_colegios', 'uses' => 'AdminController@colegios'));
	
	
});

