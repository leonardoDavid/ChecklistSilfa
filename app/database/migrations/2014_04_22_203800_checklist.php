<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Checklist extends Migration {

	/**
	 * Crea la tabla checklist que almacena cada instancia de guardado
	 * de un checklist
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('checklist',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('area_id');
			$tabla->integer('sucursal_id');
			$tabla->integer('user_id');
			$tabla->text('comentario')->nullable();
			$tabla->integer('estado');
			$tabla->timestamps();
		});
	}

	/**
	 * Elimina la tabla checklist
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('checklist');
	}

}
