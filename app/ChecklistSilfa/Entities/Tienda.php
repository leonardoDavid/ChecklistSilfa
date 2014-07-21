<?php namespace ChecklistSilfa\Entities;

class Tienda extends \Eloquent{

	protected $table = 'local';
	protected $primaryKey = 'id';

	//Retorna todas las sucursales de cierta tienda
	public function sucursales(){
        return $this->hasMany('ChecklistSilfa\Entities\Sucursal', 'local_id')->where('sucursal.estado','=','1');
    }

}
