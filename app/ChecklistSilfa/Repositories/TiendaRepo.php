<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\Tienda;

class TiendaRepo{
	
	public static function sucursales(){
		return Tienda::sucursales();
	}

	public static function count(){
		return Tienda::where('estado','=','1')->count();
	}

	public static function all(){
		return Tienda::where('estado','=','1')->get();              
	}

	public static function find($id){
		return Tienda::find($id);
	}

}