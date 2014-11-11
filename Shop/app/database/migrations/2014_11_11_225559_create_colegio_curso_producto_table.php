<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColegioCursoProductoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('colegio_curso_producto', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 300);
			$table->integer('cantidad');
			$table->integer('curso_id')->unsigned();
			$table->foreign('curso_id')->references('id')->on('colegio_curso');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('producto_producto');
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
		Schema::drop('colegio_curso_producto');
	}

}
