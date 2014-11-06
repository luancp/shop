<?php

class EmpresaTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Empresa::create(array(
			'popup_activo' => false,
		));
	}

}