<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Preguntas extends Migration {

	/**
	 * Crea la tabla preguntas que almacena las preguntas o items de
	 * los checklist
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('preguntas',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->text('texto');
			$tabla->string('tipo');
			$tabla->integer('isContable')->unsigned();
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
		});
	}

	/**
	 * Elimina la tabla preguntas
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('preguntas');
	}

}
