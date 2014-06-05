<?php
class ChecklistRepo extends Eloquent{

	protected $table = 'checklist';
	protected $primaryKey = 'id';

    //Query encargada de traer los checklist segun sea el filtro
	public function scopeReports($query,$filters = array()){
		//Creando wheres
		$query->where('checklist.estado','=','1');
        if(array_key_exists('area', $filters) && !is_null($filters['area']))
        	$query->where('checklist.area_id','=',$filters['area']);

        if(array_key_exists('tienda', $filters) && !is_null($filters['tienda']))
        	$query->where('local.id','=',$filters['tienda']);

        if(array_key_exists('sucursal', $filters) && !is_null($filters['sucursal']))
        	$query->where('checklist.sucursal_id','=',$filters['sucursal']);
        
        if(array_key_exists('user', $filters) && !is_null($filters['user']))
        	$query->where('checklist.user_id','=',$filters['user']);

        //Termino y retorno de la consulta
        return $query->join('area','area.id','=','checklist.area_id')
			->join('sucursal','sucursal.id','=','checklist.sucursal_id')
    		->join('local','local.id','=','sucursal.local_id')
    		->join('user','user.id','=','checklist.user_id')
        	->select('area.nombre as area','sucursal.nombre as sucursal','local.nombre as local','user.nombre as user','checklist.created_at as created_at','checklist.id as id');
	}

    //Trae un registro de un checklist, recibe el id para consultarlo
	public function scopeInfoReport($query,$id){
		return $query->where('checklist.id','=',$id)
					->join('area','area.id','=','checklist.area_id')
					->join('sucursal','sucursal.id','=','checklist.sucursal_id')
            		->join('local','local.id','=','sucursal.local_id')
            		->join('user','user.id','=','checklist.user_id')
            		->select('area.nombre as area','sucursal.nombre as sucursal','local.nombre as local','user.nombre as user','user.ape_paterno as last_name','checklist.created_at as created_at','area.id as area_id','checklist.comentario as comentario');
	}
}
