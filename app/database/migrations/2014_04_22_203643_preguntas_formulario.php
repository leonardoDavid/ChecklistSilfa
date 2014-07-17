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
			$tabla->integer('pregunta_id')->unsigned();
			$tabla->integer('formulario_id')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
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
