<?php

/**
* Agregamos las areas que contiene el sistema de checklist
*/
class AreaTableSeeder extends Seeder {
    public function run(){
        AreaType::create(array(
            'nombre' => "Jugueteria",
			'estado' => 1
        ));

        AreaType::create(array(
            'nombre' => "Hogar",
			'estado' => 1
        ));

        AreaType::create(array(
            'nombre' => "Bebe",
			'estado' => 1
        ));
    }
}