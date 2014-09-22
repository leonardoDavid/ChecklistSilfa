<?php

use ChecklistSilfa\Entities\Pregunta;

class PreguntasTableSeeder extends Seeder{
    public function run(){
        Pregunta::create(array(
            'texto' => "Promotor",
            'tipo' => "text",
            'isContable' => 0,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Reponedor",
            'tipo' => "text",
            'isContable' => 0,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Asistencia",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Presentación Personal",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Coches",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Sillas de Comer",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Sillas de Auto",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Cunas",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Accesorios",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Avent",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Implementacion Pop",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Stock",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Precios",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Stock Productos Fallados",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Tipo de Exhibidores",
            'isContable' => 1,
            'tipo' => "text",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Numero de Exhibidores",
            'tipo' => "text",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Layout segun CIA",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Otras Marcas",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "N° metros de Exhibicion",
            'tipo' => "text",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Implementacion Pop segun CIA",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Ofertas Vigentes",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Stock (Full Capacidad)",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Sugerido o Compra",
            'tipo' => "checkbox",
            'isContable' => 1,
			'estado' => 1
        ));

    }
}