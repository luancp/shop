<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioDireccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario_direccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('direccion');
			$table->string('telefono');
			$table->string('referencia');
			$table->integer('usuario_id')->unsigned();
			$table->foreign('usuario_id')->references('id')->on('usuario_usuario');
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
		Schema::drop('usuario_direccion');
	}

}
