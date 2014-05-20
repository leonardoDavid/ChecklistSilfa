<?php

/**
* Agregamos los formularios para las areas
*/
class FormsTableSeeder extends Seeder {
    public function run(){
        $areas = AreaType::all();

        foreach ($areas as $area){
        	FormCheck::create(array(
        		'area_id' => $area->id,
	            'nombre' => "CL-".$area->nombre,
				'estado' => 1
	        ));
        }
    }
}