<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermisosMenu extends Migration {

	/**
	 * Crea la tabla permisos_menu que contiene los permisos de que 
	 * menus un usuario tiene permisos para hacer un checklist
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('permisos_menu',function($tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('user_id');
			$tabla->integer('permisos_id');
			$tabla->timestamps();
		});
	}

	/**
	 * Elimina la tabla permisos_menu
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('permisos_menu');
	}

}
