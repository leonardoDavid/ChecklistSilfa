<?php
class ChecklistDetalle extends Eloquent{

	protected $table = 'detalle_checklist';
	protected $primaryKey = 'id';

	public function scopeDetails($query,$id){
		return $query->where('checklist_id','=',$id)
					->join('preguntas','preguntas.id','=','detalle_checklist.preguntas_form_id')
					->select('preguntas.texto as texto','preguntas.tipo as tipo','detalle_checklist.respuesta as respuesta','detalle_checklist.comentario as comentario','detalle_checklist.id as id');
	}
}
