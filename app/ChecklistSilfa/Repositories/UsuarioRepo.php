<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\Usuario;
use ChecklistSilfa\Entities\Checklist;

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

	public static function all($includeDisbled = false){
		if($includeDisbled)
			return Usuario::all();
		else
			return Usuario::where('estado','=','1')->get();
	}

	public static function countChecklist($id = null){
		if(!is_null($id)){
			return Checklist::where('user_id','=',$id)->count();
		}
		else
			return 0;
	}

}