<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\ChecklistDetalle;
use ChecklistSilfa\Entities\Checklist;

class ChecklistRepo{
	
	/*
    |--------------------------------------------------------------------------
    | Funciones Comunes
    |--------------------------------------------------------------------------
    |
    | Estas funciones son reutilizables por todos los metodos del controlador
    | que requieran informacion con respecto al modelo de checklistDetalle, que 
    | corresponde al detalle de los checklist o la lista genera de ellos que es
    | el modelo de Checklist.
    |
    */

	public static function reports($filters = array()){
		$query = Checklist::where('checklist.estado','=','1');
        if(array_key_exists('area', $filters) && !is_null($filters['area']))
        	$query->where('checklist.area_id','=',$filters['area']);

        if(array_key_exists('tienda', $filters) && !is_null($filters['tienda']))
        	$query->where('local.id','=',$filters['tienda']);

        if(array_key_exists('sucursal', $filters) && !is_null($filters['sucursal']))
        	$query->where('checklist.sucursal_id','=',$filters['sucursal']);
        
        if(array_key_exists('user', $filters) && !is_null($filters['user']))
        	$query->where('checklist.user_id','=',$filters['user']);

        return $query->join('area','area.id','=','checklist.area_id')
			->join('sucursal','sucursal.id','=','checklist.sucursal_id')
    		->join('local','local.id','=','sucursal.local_id')
    		->join('user','user.id','=','checklist.user_id')
        	->select('area.nombre as area','sucursal.nombre as sucursal','local.nombre as local','user.nombre as user','user.ape_paterno as apellido','checklist.created_at as created_at','checklist.id as id')
            ->orderBy('checklist.created_at','desc');
	}

	public static function infoReport($id){
		return Checklist::where('checklist.id','=',$id)
					->join('area','area.id','=','checklist.area_id')
					->join('sucursal','sucursal.id','=','checklist.sucursal_id')
            		->join('local','local.id','=','sucursal.local_id')
            		->join('user','user.id','=','checklist.user_id')
            		->select('area.nombre as area','sucursal.nombre as sucursal','local.nombre as local','user.nombre as user','user.ape_paterno as last_name','checklist.created_at as created_at','area.id as area_id','checklist.comentario as comentario');
	}

	public static function details($id){
		return ChecklistDetalle::where('checklist_id','=',$id)
					->join('preguntas','preguntas.id','=','detalle_checklist.preguntas_form_id')
					->select('preguntas.texto as texto','preguntas.tipo as tipo','preguntas.isContable as isContable','detalle_checklist.respuesta as respuesta','detalle_checklist.comentario as comentario','detalle_checklist.id as id');
	}

    public static function count(){
        return Checklist::where('estado','=','1')->count();
    }

}