<?php

class ColegiosTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Insertar todos los colegios
		Colegio::create(array('nombre' => 'DELFOS MATUTINO', 'empresa_id' => '1'));
		Colegio::create(array('nombre' => 'DELFOS VESPERTINO', 'empresa_id' => '1'));
		Colegio::create(array('nombre' => 'ECOMUNDO', 'empresa_id' => '1'));
		Colegio::create(array('nombre' => 'ECOMUNDO BABAHOYO', 'empresa_id' => '1'));
		Colegio::create(array('nombre' => 'ECOMUNDO BABAHOYO VESPERTINO', 'empresa_id' => '1'));
		Colegio::create(array('nombre' => 'ECOMUNDO VESPERTINO', 'empresa_id' => '1'));
		Colegio::create(array('nombre' => 'LICEO PANAMERICANO SAMBORONDON', 'empresa_id' => '1'));
		Colegio::create(array('nombre' => 'LICEO PANAMERICANO SUR', 'empresa_id' => '1'));
		Colegio::create(array('nombre' => 'MONTE TABOR', 'empresa_id' => '1'));
		
		//Insertar todos los curso por colegio
		//Delfos Matutino
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE BACHILLERATO', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'TERCER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'CUARTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'QUINTO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'SEXTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'SÉPTIMO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'OCTAVO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'NOVENO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'DECIMO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'TERCER AÑO DE BACHILLERATO', 'colegio_id' => '1'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE BACHILLERATO', 'colegio_id' => '1'));
		
		//Delfos Vespertino
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'TERCER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'CUARTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'QUINTO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'SEXTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'SÉPTIMO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'OCTAVO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'NOVENO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'DECIMO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'TERCER AÑO DE BACHILLERATO', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE BACHILLERATO ', 'colegio_id' => '2'));
		Curso::create(array('nombre' => 'SEGUNDO BACHILLERATO', 'colegio_id' => '2'));
		
		//Ecomundo
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'TERCER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'CUARTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'QUINTO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'SEXTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'SÉPTIMO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'OCTAVO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'NOVENO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'DECIMO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE BACHILLERATO', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'MATERNAL', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE BACHILLERATO', 'colegio_id' => '3'));
		Curso::create(array('nombre' => 'TERCERO DE BACHILLERATO', 'colegio_id' => '3'));
		
		//Ecomundo Babahoyo
		Curso::create(array('nombre' => 'PRIMER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'TERCER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'CUARTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'QUINTO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'SEXTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'SÉPTIMO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'OCTAVO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'NOVENO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'DECIMO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE BACHILLERATO', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE BACHILLERATO', 'colegio_id' => '4'));
		Curso::create(array('nombre' => 'TERCER AÑO DE BACHILLERATO', 'colegio_id' => '4'));
		
		//Ecomundo Babahoyo Vespertino
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'TERCER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'CUARTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'QUINTO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'SEXTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'SÉPTIMO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'OCTAVO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'NOVENO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'DECIMO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE BACHILLERATO', 'colegio_id' => '5'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE BACHILLERATO', 'colegio_id' => '5'));
		
		//Ecomundo Vespertino
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'TERCER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'CUARTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'QUINTO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'SEXTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'SÉPTIMO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'OCTAVO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'NOVENO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'DECIMO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE BACHILLERATO', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE BACHILLERATO FIMA', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'TERCER AÑO DE BACHILLERATO', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE BACHILLERATO QUIBIO', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE BACHILLERATO SOCIALES', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'TERCER AÑO DE BACHILLERATO GESTION EMPRESARIAL', 'colegio_id' => '6'));
		Curso::create(array('nombre' => 'MATERNAL', 'colegio_id' => '6'));
		
		//LICEO PANAMERICANO SAMBORONDON
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE BACHILLERATO', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'TERCER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'CUARTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'OCTAVO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'NOVENO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'DECIMO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE BACHILLERATO', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'TERCER AÑO DE BACHILLERATO', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'QUINTO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'SEXTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'SÉPTIMO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '7'));
		Curso::create(array('nombre' => 'MATERNAL', 'colegio_id' => '7'));
		
		//Liceo Panamericano Sur
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'SEGUNDO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'TERCER AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'CUARTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'OCTAVO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'NOVENO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'DECIMO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'PRIMER AÑO DE BACHILLERATO', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'TERCER AÑO DE BACHILLERATO', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'QUINTO AÑO DE  EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'SEXTO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		Curso::create(array('nombre' => 'SÉPTIMO AÑO DE EDUCACIÓN BÁSICA', 'colegio_id' => '8'));
		
		//Monte Tabor
		Curso::create(array('nombre' => 'PREKINDER', 'colegio_id' => '9'));
		Curso::create(array('nombre' => 'KINDER', 'colegio_id' => '9'));
		Curso::create(array('nombre' => 'MATERNAL', 'colegio_id' => '9'));
		Curso::create(array('nombre' => 'PRIMERO BASICO', 'colegio_id' => '9'));
		Curso::create(array('nombre' => 'SEGUNDO BASICO', 'colegio_id' => '9'));
	}

}