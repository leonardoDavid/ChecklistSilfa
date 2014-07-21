<?php

use ChecklistSilfa\Entities\Area;
use ChecklistSilfa\Entities\FormCheck;

class FormsTableSeeder extends Seeder {
    public function run(){
        $areas = Area::all();

        foreach ($areas as $area){
        	FormCheck::create(array(
        		'area_id' => $area->id,
	            'nombre' => "CL-".$area->nombre,
				'estado' => 1
	        ));
        }
    }
}