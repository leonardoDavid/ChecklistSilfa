<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration {

	/**
	 * Crea la tabla user que almacena las personas que tienen login en el 
	 * sistema de checklist
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('user',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->string('rut',10);
			$tabla->string('mail',80);
			$tabla->string('username',80);
			$tabla->string('password',200);
			$tabla->string('nombre',80);
			$tabla->string('ape_paterno',80);
			$tabla->string('ape_materno',80)->nullable();
			$tabla->integer('tel_movil')->nullable();
			$tabla->integer('tel_fijo')->nullable();
			$tabla->integer('estado');
			$tabla->string('remember_token');
			$tabla->timestamps();
		});
	}

	/**
	 * Elimina la tabla user
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('user');
	}

}
