<?php

class Colegio extends Eloquent {

	protected $table = 'colegio_colegio';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static function validar($nombre, $id = null){
		$rules = array(
			'nombre' => 'required|unique:colegio_colegio,nombre,'.$id.''
		);
		$data = array(
			'nombre' => $nombre
		);
		$validator = Validator::make($data, $rules);
		return $validator;
	}
	
	public function cursos(){
		$cursos = $this->hasMany('Curso')->orderBy('id', 'DESC');
		return $cursos;
	}


}
