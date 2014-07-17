<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleChecklist extends Migration {

	/**
	 * Crea la tabla detalle_checklist que almacena la relacion entre la pregunta y el 
	 * checklist realizado, aqui se almacena un comentario por item
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('detalle_checklist',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('checklist_id')->unsigned();
			$tabla->integer('preguntas_form_id')->unsigned();
			$tabla->string('respuesta');
			$tabla->text('comentario')->nullable();
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
		});
	}

	/**
	 * Elimina la tabla detalle_checklist
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('detalle_checklist');
	}

}
