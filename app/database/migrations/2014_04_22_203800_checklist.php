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
			$tabla->integer('area_id')->unsigned();
			$tabla->integer('sucursal_id')->unsigned();
			$tabla->integer('user_id')->unsigned();
			$tabla->text('comentario')->nullable();
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
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
