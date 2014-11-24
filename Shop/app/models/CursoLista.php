<?php

class CursoLista extends Eloquent {

	protected $table = 'colegio_curso_producto';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	//retorna el producto
	public function producto(){
		$p = $this->belongsTo('Producto');
		return $p;
	}
	
	//retorna el curso
	public function Curso(){
		$c = $this->belongsTo('Curso');
		return $c;
	}
	
}
