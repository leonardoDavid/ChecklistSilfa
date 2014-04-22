<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Local extends Migration {

	/**
	 * Crea la tabla local que almacena las tiendas donde se realizan
	 * los checklist
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('local',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->string('nombre',100);
			$tabla->integer('estado');
			$tabla->timestamps();
		});
	}

	/**
	 * Elimina la tabla local
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('local');
	}

}
