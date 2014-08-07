<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\Usuario;
use ChecklistSilfa\Entities\Checklist;
use Illuminate\Support\Facades\Auth;

class UsuarioRepo{
	
	public static function menus(){
		return Usuario::menus();
	}

	public static function count($includeMe = false){
		if($includeMe)
			return Usuario::where('estado','=','1')->count();
		else
			return Usuario::where('estado','=','1')->where('id','!=',Auth::user()->id)->count();
	}

	public static function find($id){
		return Usuario::find($id);
	}

	public static function all($includeDisbled = true){
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

	public static function withOutMe($includeDisbled = true){
		if($includeDisbled)
			return Usuario::where('id','!=',Auth::user()->id)->get();
		else
			return Usuario::where('estado','=','1')->where('id','!=',Auth::user()->id)->get();
	}

}