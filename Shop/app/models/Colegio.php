<?php

class Colegio extends Eloquent {

	protected $table = 'colegio_colegio';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static function validar($nombre){
		$rules = array(
			'nombre' => 'required|unique:colegio_colegio,nombre'
		);
		$data = array(
			'nombre' => $nombre
		);
		$validator = Validator::make($data, $rules);
		return $validator;
	}


}
