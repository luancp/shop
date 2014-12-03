<?php

class Wishlist extends Eloquent {

	protected $table = 'usuario_wishlist';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	//verifica si existe la categoria en la base de datos
	public static function existeProducto($usuario_id, $producto_id){
		try{
			if($producto_id == '' || is_null($producto_id)){
				return false;
			}
			if($usuario_id == '' || is_null($usuario_id)){
				return false;
			}
			$c = self::where('producto_id', $producto_id)->where('usuario_id', $usuario_id)->first();
			if(isset($c->id)){
				return true;
			}else{
				return false;
			}
		}catch(Exception $e){
			return false;
		}
	}
	
	public function producto(){
		return $this->belongsTo('Producto', 'producto_id');
	}

	public function usuario(){
		return $this->belongsTo('Usuario', 'usuario_id');
	}

	

}
