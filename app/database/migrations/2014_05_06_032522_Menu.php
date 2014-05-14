<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Menu extends Migration {

	/**
	 * Crea la tabla menu que contiene los items o menus
	 * de cierto checklistque existen en el sistema
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('menu',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->string('nombre');
			$tabla->string('url');
			$tabla->string('icon');
			$tabla->integer('estado');
			$tabla->timestamps();
		});
	}

	/**
	 * Elimina la tabla menu
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('menu');
	}

}
