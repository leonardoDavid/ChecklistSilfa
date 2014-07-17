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
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
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
