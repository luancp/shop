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
			if($id == ''){
				return false;
			}
			$c = self::where('contifico_id', $id)->first();
			if(isset($c->id)){
				return true;
			}else{
				return false;
			}
		}catch(Exception $e){
			Log::info('Categoria-Existe: '.$e);
			return false;
		}
	}

	//verifica si existe la categoria padre en la base de datos
	public static function existeCategoriaPadre($padre_id){
		try{
			if($padre_id == ''){
				return 0;
			}
			$c = self::where('contifico_id', $padre_id)->first();
			if(isset($c->id)){
				return $c->id;
			}else{
				return -1;
			}
		}catch(Exception $e){
			Log::info('Categoria-ExistePadre: '.$e);
			return -1;
		}
	}

	//crea la categoria en la base de datos
	public static function crearCategoria($id, $nombre, $codigo, $padre_id = null, $padre_nombre, $padre_codigo){
		try{
			$padre = null;
			$categoria_padre = self::existeCategoriaPadre($padre_id);
			if($categoria_padre < 0){
				Log::info('paso categoria padre....');			
				$padre = new Categoria;
				$padre->nombre = $padre_nombre;
				$padre->codigo = $padre_codigo;
				$padre->contifico_id = $padre_id;
				$padre->padre_id = null;
				$padre->save();
								
				$padre = $padre->id;
			}else{
				if($categoria_padre == 0){
					$padre = null;
				}else{
					$padre = $categoria_padre;
				}
			}
			$c = new Categoria;
			$c->nombre = $nombre;
			$c->codigo = $codigo;
			$c->contifico_id = $id;
			$c->padre_id = $padre;
			$c->save();
			return $c->id;
		}catch(Exception $e){
			Log::info('Categoria-Crear: '.$e);
			return -1;
		}
	}

	//setea la categoria en la base de datos
	public static function setearCategoria($id, $nombre, $codigo, $padre_id = null, $padre_nombre, $padre_codigo){
		try{
			$c = self::where('contifico_id', $id)->first();
			$c->nombre = $nombre;
			$c->codigo = $codigo;
			return $c->id;
		}catch(Exception $e){
			Log::info('Categoria-Set: '.$e);
			return -1;
		}
	}

	//obtiene la cantidad total de productos por categorias
	public function getCantidadProductos(){
		$productos = Producto::where('categoria_id', $this->id);
		return $productos->count();		 
	}
	
	//retorna los hijos de la categoria
	public function getHjios(){
		$hijos = $this->hasMany('Categoria', 'padre_id');
		return $hijos;
	}

	//retorna los hijos de la categoria
	public function tieneHijos(){
		$hijos = self::getHjios()->count();
		return ($hijos > 0);
	}

}
