<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\Usuario;

class UsuarioRepo{
	
	public static function menus(){
		return Usuario::menus();
	}

	public static function count(){
		return Usuario::where('estado','=','1')->count();
	}

	public static function find($id){
		return Usuario::find($id);
	}

	public static function all(){
		return Usuario::where('estado','=','1')->get();
	}

}