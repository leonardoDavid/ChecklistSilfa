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
			$tabla->integer('local_id');
			$tabla->string('nombre',100);
			$tabla->string('direccion',200)->nullable();
			$tabla->integer('estado');
			$tabla->timestamps();
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
