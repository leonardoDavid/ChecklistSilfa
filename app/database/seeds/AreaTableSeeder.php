<?php

use ChecklistSilfa\Entities\Area;

class AreaTableSeeder extends Seeder {
    public function run(){
        Area::create(array(
            'nombre' => "Jugueteria",
			'estado' => 1
        ));

        Area::create(array(
            'nombre' => "Hogar",
			'estado' => 1
        ));

        Area::create(array(
            'nombre' => "Bebe",
			'estado' => 1
        ));
    }
}