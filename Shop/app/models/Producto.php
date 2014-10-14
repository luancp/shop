<?php


class Producto extends Eloquent {

	protected $table = 'producto_producto';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static function procesar($json=''){
		if(isset($json->error)){
			return ;
		}
		dd($json->data);
		foreach ($json->data as $d){
			
		}
	}

}
