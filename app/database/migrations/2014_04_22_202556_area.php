<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Area extends Migration {

	/**
	 * Crea la tabla area que almacena las correspondientes areas de los checklist
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('area',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->string('nombre',100);
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
		});
	}

	/**
	 * Elimina la tabla area
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('area');
	}

}
