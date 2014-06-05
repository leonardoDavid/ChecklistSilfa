<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreguntasFormulario extends Migration {

	/**
	 * Crea la tabla preguntas_formulario que contiene los items o preguntas
	 * de cierto checklist
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('preguntas_formulario',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('pregunta_id');
			$tabla->integer('formulario_id');
			$tabla->timestamps();
		});
	}

	/**
	 * Elimina la tabla preguntas_formulario
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('preguntas_formulario');
	}

}
