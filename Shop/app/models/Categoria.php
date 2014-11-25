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
	public static function crearCategoria($id, $nombre, $codigo, $padre_id, $padre_nombre, $padre_codigo){
		try{
			$padre = null;
			if(!is_null($padre_id)){
				$c = self::where('contifico_id', $padre_id)->first();
				if(is_null($c->id)){
					$padre = new Categoria;
					$padre->nombre = $padre_nombre;
					$padre->codigo = $padre_codigo;
					$padre->contifico_id = $padre_id;
					$padre->padre_id = null;
					$padre->save();
				}else{
					$padre = $c;
				}
			}
			$c = new Categoria;
			$c->nombre = $nombre;
			$c->codigo = $codigo;
			$c->contifico_id = $id;
			$c->padre_id = $padre->id;
			$c->save();
			return $c->id;
		}catch(Exception $e){
			return -1;
		}
	}

	//setea la categoria en la base de datos
	public static function setearCategoria($id, $nombre, $codigo, $padre){
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

	//obtiene la cantidad total de productos por categorias
	public function getCantidadProductos(){
		$productos = Producto::where('categoria_id', $this->id);
		return $productos->count();		 
	}

}
