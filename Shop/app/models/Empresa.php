<?php

class Empresa extends Eloquent {

	protected $table = 'empresa_empresa';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static function marcarSincronizacion($datetime, $id){
		$emp = self::findOrFail($id);
		$emp->ultima_sincronizacion = $datetime;
		$emp->save();
	}

}
