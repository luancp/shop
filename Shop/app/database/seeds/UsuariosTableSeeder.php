<?php

class UsuariosTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Usuario::create(array(
			'usuario' => 'admin',
			'password' => Hash::make('admin'),
			'token' => Hash::make('admin'),
			'nombres' => 'Nombre Usuario',
			'apellidos' => 'Apellido Usuario',
			'email' => 'jgaibory@gmail.com',
			'remember_token' => Hash::make('admin'),
			'es_admin' => '1',
			'estado' => 'A'
		));
		Usuario::create(array(
			'usuario' => 'venta',
			'password' => Hash::make('venta'),
			'token' => Hash::make('venta'),
			'nombres' => 'Nombre Usuario2',
			'apellidos' => 'Apellido Usuario2',
			'email' => 'jgaibory@gmail.com',
			'remember_token' => Hash::make('venta'),
			'es_admin' => '0',
			'estado' => 'A'
		));
	}

}