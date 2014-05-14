<?php
class SucursalPlace extends Eloquent{

	protected $table = 'sucursal';
	protected $primaryKey = 'id';

	public function tienda(){
        return $this->belongsTo('Tienda');
    }

}
