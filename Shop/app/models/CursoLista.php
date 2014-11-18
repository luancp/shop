<?php

class CursoLista extends Eloquent {

	protected $table = 'colegio_curso_producto';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public function producto(){
		$p = $this->belongsTo('Producto');
		return $p;
	}
	
}
