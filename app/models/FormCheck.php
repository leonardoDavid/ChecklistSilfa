<?php
class FormCheck extends Eloquent{

	protected $table = 'formulario';
	protected $primaryKey = 'id';

	//Relacion que indica "la tabla formulario tiene muchas preguntas", toma los registros de una table intermedia
	public function preguntas(){
        return $this->belongsToMany('Pregunta', 'preguntas_formulario', 'formulario_id', 'pregunta_id')->where('preguntas.estado','=','1');
    }
}
