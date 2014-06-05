<?php
class Tienda extends Eloquent{

	protected $table = 'local';
	protected $primaryKey = 'id';

	//Retorna todas las sucursales de cierta tienda
	public function sucursales(){
        return $this->hasMany('SucursalPlace', 'local_id')->where('sucursal.estado','=','1');
    }

}
