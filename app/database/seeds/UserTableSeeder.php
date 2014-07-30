<?php

use ChecklistSilfa\Entities\Usuario;

class UserTableSeeder extends Seeder {
    public function run(){
        Usuario::create(array(
            'rut' => "111111111",
			'email' => "testing@swert.cl",
			'username' => "admin",
			'password' => Hash::make('test'),
			'nombre' => "Testing",
			'ape_paterno' => "Swert",
			'estado' => 1
        ));
    }
}