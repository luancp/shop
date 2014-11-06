<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaEmpresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa_empresa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('facebook_plugin_activo')->default(false);
			$table->longText('facebook_plugin_script')->nullable()->default(null);
			
			$table->boolean('google_plugin_activo')->default(false);
			$table->longText('google_plugin_script')->nullable()->default(null);
			
			$table->boolean('popup_activo')->default(false);
			$table->string('popup_titulo')->nullable()->default(null);
			$table->string('popup_imagen')->nullable()->default(null);
			
			$table->dateTime('ultima_sincronizacion')->nullable()->default(null);
			
			$table->timestamps();
		});
		//Crea los foreingkey para las tablas
		Schema::table('producto_producto', function($table){
		    $table->integer('empresa_id')->unsigned();
			$table->foreign('empresa_id')->references('id')->on('empresa_empresa');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Elimina los foreingkey para las tablas
		Schema::table('producto_producto', function($table){
		    $table->dropForeign('producto_producto_empresa_id_foreign');
		});
		Schema::drop('empresa_empresa');
	}

}
