<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario_usuario', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('usuario', 10)->unique();
            $table->string('password', 100);
            $table->string('token', 100);
            $table->string('nombres', 200);
            $table->string('apellidos', 200);
            $table->string('email', 100);
            $table->string('remember_token', 100);
            $table->boolean('es_admin')->default('0');
            $table->enum('estado', array('A', 'I', 'S')); //activo, inactivo, suspendido
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
		Schema::drop('usuario_usuario');
	}

}
