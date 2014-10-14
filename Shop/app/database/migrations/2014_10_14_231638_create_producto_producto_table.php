<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoProductoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('producto_producto', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre', 300);
            $table->string('descripcion', 300);
            $table->string('codigo', 50);
            $table->string('tipo_producto', 3);
            $table->integer('stock');
            $table->integer('contifico_id');
            $table->integer('categoria_id')->unsigned();
			$table->foreign('categoria_id')->references('id')->on('categoria_categoria');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('producto_producto');
	}

}
