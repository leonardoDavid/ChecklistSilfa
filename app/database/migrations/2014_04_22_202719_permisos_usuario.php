<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermisosUsuario extends Migration {

	/**
	 * Crea la tabla permisos_usuario que contiene los permisos de que 
	 * areas un usuario tiene permisos para hacer un checklist
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('permisos_usuario',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('user_id');
			$tabla->integer('area_id');
			$tabla->timestamps();
		});
	}

	/**
	 * Elimina la tabla permisos_usuario
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('permisos_usuario');
	}

}
