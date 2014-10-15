<?php

class Categoria extends Eloquent {

	protected $table = 'categoria_categoria';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	//verifica si existe la categoria en la base de datos
	public static function existeCategoria($id){
		try{
			$c = self::where('contifico_id', $id)->first();
			if(!is_null($c)){
				return true;
			}else{
				return false;
			}
		}catch(ModelNotFoundException $e){
			return false;
		}
	}

	//crea la categoria en la base de datos
	public static function crearCategoria($id, $nombre, $codigo){
		try{
			$c = new Categoria;
			$c->nombre = $nombre;
			$c->codigo = $codigo;
			$c->contifico_id = $id;
			$c->save();
			return $c->id;
		}catch(Exception $e){
			return -1;
		}
	}

	//setea la categoria en la base de datos
	public static function setearCategoria($id, $nombre, $codigo){
		try{
			$c = self::where('contifico_id', $id)->first();
			$c->nombre = $nombre;
			$c->codigo = $codigo;
			$c->save();
			return $c->id;
		}catch(Exception $e){
			return -1;
		}
	}

}
