<?php

/**
* Agregamos las pregnutas de los checklist
*/
class PreguntasTableSeeder extends Seeder{
    public function run(){
        Pregunta::create(array(
            'texto' => "Promotor",
            'tipo' => "text",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Reponedor",
            'tipo' => "text",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Asistencia",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Presentación Personal",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Coches",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Sillas de Comer",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Sillas de Auto",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Cunas",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Accesorios",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Exhibiciones Aven",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Implementacion Pop",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Stock",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Precios",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Stock Productos Fallados",
            'tipo' => "checkbox",
			'estado' => 1
        ));

        Pregunta::create(array(
            'texto' => "Tipo de Exhibidores",
            'tipo' => "text",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Numero de Exhibidores",
            'tipo' => "text",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Layout segun CIA",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Otras Marcas",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "N° metros de Exhibicion",
            'tipo' => "text",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Implementacion Pop segun CIA",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Ofertas Vigentes",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Stock (Full Capacidad)",
            'tipo' => "checkbox",
			'estado' => 1
        ));
        Pregunta::create(array(
            'texto' => "Sugerido o Compra",
            'tipo' => "checkbox",
			'estado' => 1
        ));

    }
}