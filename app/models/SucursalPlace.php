<?php
class SucursalPlace extends Eloquent{

	protected $table = 'sucursal';
	protected $primaryKey = 'id';

	//Busca automagicamente las relaciones con el modelo Tienda
	public function tienda(){
        return $this->belongsTo('Tienda');
    }

}
