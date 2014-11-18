<?php

class Curso extends Eloquent {

	protected $table = 'colegio_curso';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public function listas(){
		$listas = $this->hasMany('CursoLista')->orderBy('id', 'DESC');
		return $listas;
	}

}
