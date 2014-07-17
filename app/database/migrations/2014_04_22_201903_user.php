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
			$tabla->string('email',150);
			$tabla->string('username',50);
			$tabla->string('password',200);
			$tabla->string('nombre',80);
			$tabla->string('ape_paterno',80);
			$tabla->string('ape_materno',80)->nullable();
			$tabla->integer('tel_movil')->nullable()->unsigned();
			$tabla->integer('tel_fijo')->nullable()->unsigned();
			$tabla->integer('estado')->unsigned();
			$tabla->string('remember_token');
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
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
