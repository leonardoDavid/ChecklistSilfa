<?php
class FormCheck extends Eloquent{

	protected $table = 'formulario';
	protected $primaryKey = 'id';

	public function preguntas(){
        return $this->belongsToMany('Pregunta', 'preguntas_formulario', 'formulario_id', 'pregunta_id')->where('preguntas.estado','=','1');
    }
}
