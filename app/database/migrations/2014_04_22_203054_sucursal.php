<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sucursal extends Migration {

	/**
	 * Crea la tabla sucursal que almacena las sucursales de una tienda
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('sucursal',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('local_id')->unsigned();
			$tabla->string('nombre',100);
			$tabla->string('direccion',200)->nullable();
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
		});
	}

	/**
	 * Elimina la tabla sucursal
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('sucursal');
	}

}
