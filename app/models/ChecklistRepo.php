<?php
class ChecklistRepo extends Eloquent{

	protected $table = 'checklist';
	protected $primaryKey = 'id';

	public function scopeReports($query,$area = null){
		return $query->where('checklist.estado','=','1')
					->join('area','area.id','=','checklist.area_id')
					->join('sucursal','sucursal.id','=','checklist.sucursal_id')
            		->join('local','local.id','=','sucursal.local_id')
            		->join('user','user.id','=','checklist.user_id')
            		->select('area.nombre as area','sucursal.nombre as sucursal','local.nombre as local','user.nombre as user','checklist.created_at as created_at','checklist.id as id');
	}

	public function scopeInfoReport($query,$id){
		return $query->where('checklist.id','=',$id)
					->join('area','area.id','=','checklist.area_id')
					->join('sucursal','sucursal.id','=','checklist.sucursal_id')
            		->join('local','local.id','=','sucursal.local_id')
            		->join('user','user.id','=','checklist.user_id')
            		->select('area.nombre as area','sucursal.nombre as sucursal','local.nombre as local','user.nombre as user','user.ape_paterno as last_name','checklist.created_at as created_at','area.id as area_id','checklist.comentario as comentario');
	}
}
