<?php


class Producto extends Eloquent {

	protected $table = 'producto_producto';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	//procesa los datos que vienen del api contifico
	public static function procesar($json=''){
		if(isset($json->error)){
			return ;
		}
		//dd($json->data);
		$id_categoria = 0;
		foreach ($json->data as $d){
			if(!Categoria::existeCategoria($d->categoria->id)){ //no existe categoria
				$id_categoria = Categoria::crearCategoria($d->categoria->id, $d->categoria->nombre, $d->categoria->codigo, $d->categoria->padre_id, $d->categoria->padre_nombre, $d->categoria->padre_codigo);
			}else{
				$id_categoria = Categoria::setearCategoria($d->categoria->id, $d->categoria->nombre, $d->categoria->codigo, $d->categoria->padre_id, $d->categoria->padre_nombre, $d->categoria->padre_codigo);
			}
			if(!self::existeProducto($d->id)){ //no existe producto
				$id_producto = self::crearProducto($d->id, $d->nombre, $d->codigo, $d->stock, $d->descripcion, $d->tipo_producto, $id_categoria, $d->precio);
			}else{
				$id_producto = self::setearProducto($d->id, $d->nombre, $d->codigo, $d->stock, $d->descripcion, $d->tipo_producto, $id_categoria, $d->precio);
			}
		}
	}
	
	//verifica si existe el producto
	public static function existeProducto($id){
		try{
			$p = self::where('contifico_id', $id)->first();
			if(!is_null($p)){
				return true;
			}else{
				return false;
			}
		}catch(ModelNotFoundException $e){
			Log::info('Producto Existe: '.$e);
			return false;
		}
	}
	
	//guarda un producto
	public static function crearProducto($id, $nombre, $codigo, $stock, $descripcion, $tipo_producto, $id_categoria, $precio){
		try{
			$p = new Producto;
			$p->nombre = $nombre;
			$p->codigo = $codigo;
			$p->descripcion = $descripcion;
			$p->stock = $stock;
			if($precio){
				$p->precio = $precio;
			}else{
				$p->precio = (float)0.00;
			}
			$p->tipo_producto = $tipo_producto;
			$p->categoria_id = $id_categoria;
			$p->contifico_id = $id;
			$p->empresa_id = 1;
			$p->save();
			return $p->id;
		}catch(Exception $e){
			Log::info('Producto Crear: '.$e);
			return -1;
		}
	}

	//setea un producto guardado
	public static function setearProducto($id, $nombre, $codigo, $stock, $descripcion, $tipo_producto, $id_categoria, $precio){
		try{
			$p = self::where('contifico_id', $id)->first();
			$p->nombre = $nombre;
			$p->codigo = $codigo;
			$p->descripcion = $descripcion;
			$p->stock = $stock;
			if($precio){
				$p->precio = $precio;
			}else{
				$p->precio = (float)0.00;
			}
			$p->tipo_producto = $tipo_producto;
			$p->categoria_id = $id_categoria;
			$p->contifico_id = $id;
			$p->save();
			return $p->id;
		}catch(Exception $e){
			Log::info('Producto Set: '.$e);
			return -1;
		}
	}
	
	//retorna la categoria del producto
	public function categoria(){
		return $this->belongsTo('Categoria');
	}

}
