<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColegioCursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('colegio_curso', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 300);
			$table->integer('colegio_id')->unsigned();
			$table->foreign('colegio_id')->references('id')->on('colegio_colegio');
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
		Schema::drop('colegio_curso');
	}

}
