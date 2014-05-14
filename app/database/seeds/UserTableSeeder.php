<?php

/**
* Agregamos un usuario nuevo a la base de datos.
*/
class UserTableSeeder extends Seeder {
    public function run(){
        Usuario::create(array(
            'rut' => "111111111",
			'email' => "testing@testing.evo",
			'username' => "test",
			'password' => Hash::make('mypass'), // Hash::make() nos va generar una cadena con nuestra contraseña encriptada
			'nombre' => "Usuario",
			'ape_paterno' => "De Pruebas",
			'remember_token' => "Asd",
			'estado' => 1
        ));
    }
}