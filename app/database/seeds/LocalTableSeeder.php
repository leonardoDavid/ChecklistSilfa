<?php

/**
* Agregamos los locales por defecto
*/
class LocalTableSeeder extends Seeder{
    public function run(){
        $local = Tienda::create(array(
            'nombre' => "Falabella",
			'estado' => 1
        ));

        $local = Tienda::create(array(
            'nombre' => "Hites",
			'estado' => 1
        ));

        $local = Tienda::create(array(
            'nombre' => "La Polar",
			'estado' => 1
        ));

        $local = Tienda::create(array(
            'nombre' => "Paris",
			'estado' => 1
        ));

        $local = Tienda::create(array(
            'nombre' => "Ripley",
			'estado' => 1
        ));

        
    }
}