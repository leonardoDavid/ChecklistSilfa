<?php

/**
* Agregamos un usuario nuevo a la base de datos.
*/
class UserTableSeeder extends Seeder {
    public function run(){
        Usuario::create(array(
            'rut' => "111111111",
			'email' => "testing@swert.cl",
			'username' => "test",
			// Hash::make() nos va generar una cadena con nuestra contraseña encriptada
			'password' => Hash::make('mypass'),
			'nombre' => "Testing",
			'ape_paterno' => "Swert",
			'remember_token' => "future-token",
			'estado' => 1
        ));
    }
}