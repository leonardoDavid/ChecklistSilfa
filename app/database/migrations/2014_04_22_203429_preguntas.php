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
			$tabla->integer('orden');
			$tabla->integer('estado');
			$tabla->timestamps();
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
