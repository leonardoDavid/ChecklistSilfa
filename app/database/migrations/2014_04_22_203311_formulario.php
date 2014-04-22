<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Formulario extends Migration {

	/**
	 * Crea la tabla formulario que almacena los nombres de los 
	 * los checklist, y a que area pertenecen
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('formulario',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('area_id');
			$tabla->string('nombre',100);
			$tabla->integer('estado');
			$tabla->timestamps();
		});
	}

	/**
	 * Elimina la tabla formulario
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('formulario');
	}

}
