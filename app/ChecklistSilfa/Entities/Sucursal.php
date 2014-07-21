<?php namespace ChecklistSilfa\Entities;

class Sucursal extends \Eloquent{

	protected $table = 'sucursal';
	protected $primaryKey = 'id';

	//Busca automagicamente las relaciones con el modelo Tienda
	public function tienda(){
        return $this->belongsTo('ChecklistSilfa\Entities\Tienda');
    }

}
