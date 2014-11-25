<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaCategoriaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categoria_categoria', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre', 300);
            $table->string('codigo', 50);
            $table->integer('contifico_id');
            $table->integer('padre_id')->nullable()->default(null)->unsigned();
			$table->foreign('padre_id')->references('id')->on('categoria_categoria');
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
		Schema::drop('categoria_categoria');
	}

}
