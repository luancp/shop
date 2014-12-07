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
	
	//obtiene los productos de tipo lista
	public function productoslista(){
		$listas = $this->hasMany('CursoLista')->where('tipo', 'NOR')->orderBy('id', 'DESC');
		return $listas;
	}
	
	//obtiene los productos de tipo complemento
	public function complementoslista(){
		$listas = $this->hasMany('CursoLista')->where('tipo', 'COM')->orderBy('id', 'DESC');
		return $listas;
	}

	//retorna todos los productos del curso
	public function productos(){
		$productos = $this->belongsToMany('Producto', 'colegio_curso_producto', 'curso_id', 'producto_id');
        return $productos;
    }
}
