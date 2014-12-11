<?php

class UsuarioDireccion extends Eloquent {

	protected $table = 'usuario_direccion';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static function validar($input){
		$rules = array(
			'nombre' => 'required',
			'direccion' => 'required',
			'telefono' => 'required',
			'referencia' => 'required',
		);
		$data = array(
			'nombre' => $input['nombre'],
			'direccion' => $input['direccion'],
			'telefono' => $input['telefono'],
			'referencia' => $input['referencia'],
		);
		$validator = Validator::make($data, $rules);
		return $validator;
	}
	
	

}
