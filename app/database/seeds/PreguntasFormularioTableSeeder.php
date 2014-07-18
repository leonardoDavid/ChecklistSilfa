<?php

/**
* Agregamos detalles de Preguntas Formulario
*/
class PreguntasFormularioTableSeeder extends Seeder {
    public function run(){
        //Formulario de jugueteria
        PreguntaFormulario::create(array('pregunta_id' => 1,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 2,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 13,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 14,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 15,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 17,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 19,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 20,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 21,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 22,'formulario_id' => 1));
        PreguntaFormulario::create(array('pregunta_id' => 23,'formulario_id' => 1));

        //Formulario Hogar
        PreguntaFormulario::create(array('pregunta_id' => 2,'formulario_id' => 2));
        PreguntaFormulario::create(array('pregunta_id' => 11,'formulario_id' => 2));
        PreguntaFormulario::create(array('pregunta_id' => 12,'formulario_id' => 2));
        PreguntaFormulario::create(array('pregunta_id' => 13,'formulario_id' => 2));
        PreguntaFormulario::create(array('pregunta_id' => 14,'formulario_id' => 2));
        PreguntaFormulario::create(array('pregunta_id' => 15,'formulario_id' => 2));
        PreguntaFormulario::create(array('pregunta_id' => 16,'formulario_id' => 2));
        PreguntaFormulario::create(array('pregunta_id' => 17,'formulario_id' => 2));
        PreguntaFormulario::create(array('pregunta_id' => 18,'formulario_id' => 2));

        //Formulario Bebe
        PreguntaFormulario::create(array('pregunta_id' => 1,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 2,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 3,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 4,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 5,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 6,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 7,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 8,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 9,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 10,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 11,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 12,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 13,'formulario_id' => 3));
        PreguntaFormulario::create(array('pregunta_id' => 14,'formulario_id' => 3));

    }
}