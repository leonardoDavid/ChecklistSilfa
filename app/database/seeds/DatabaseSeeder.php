<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Llamada a los archivos que se deben correr para poblar la DB
		Eloquent::unguard();
		$this->call('UserTableSeeder');
		$this->call('AreaTableSeeder');
		$this->call('FormsTableSeeder');
		$this->call('LocalTableSeeder');
		$this->call('MenuTableSeeder');
		$this->call('PreguntasTableSeeder');
		$this->call('PreguntasFormularioTableSeeder');
	}

}
