<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColegioColegioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('colegio_colegio', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre', 300);
            $table->string('imagen', 100);
			$table->integer('empresa_id')->unsigned();
			$table->foreign('empresa_id')->references('id')->on('empresa_empresa');
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
		Schema::drop('colegio_colegio');
	}

}
