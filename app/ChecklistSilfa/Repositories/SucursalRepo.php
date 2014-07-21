<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\Sucursal;

class SucursalRepo{
	
	public static function tienda(){
		return Sucursal::tienda();
	}

	public static function find($id){
		return Sucursal::find($id);
	}

}