<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\Area;

class AreaRepo{
	
	public static function all(){
		return Area::where('estado','=','1')->get();
	}

	public static function find($id){
		return Area::find($id);
	}

}