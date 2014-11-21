<?php

class ProductosTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Categoria::create(array(
			'nombre' => 'Categoria 1',
			'codigo' => 'Categoria 1',
			'contifico_id' => '1',
		));
		Categoria::create(array(
			'nombre' => 'Categoria 2',
			'codigo' => 'Categoria 2',
			'contifico_id' => '1',
		));
		
		Producto::create(array(
			'nombre' => 'Uniforme Delfos Talla 28',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '1',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Uniforme Delfos Talla 30',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '2',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Uniforme Delfos Talla 32',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '2',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Uniforme Delfos Talla 34',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '1',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Uniforme Delfos Talla 36',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '2',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Uniforme Delfos Talla 38',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '1',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Uniforme Delfos Talla 40',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '2',
			'empresa_id' => '1',
		));
		//-----------------------------------------------------
		Producto::create(array(
			'nombre' => 'Cuadernos Norma cuadriculado',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '2',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Cuaderno Norma de lineas',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '1',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Algebra de Baldor',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '1',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Caja de 12 marcadores',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '2',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Caja de 32 lapices de colores',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '1',
			'empresa_id' => '1',
		));
		Producto::create(array(
			'nombre' => 'Marcadores de pizzara',
			'descripcion' => 'Descripcion Producto con algo mas de texto para ver como funciona',
			'codigo' => 'codigo1',
			'tipo_producto' => 'SIM',
			'stock' => '23',
			'precio' => '123.90',
			'contifico_id' => '1',
			'categoria_id' => '2',
			'empresa_id' => '1',
		));
	}

}