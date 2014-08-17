<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\Pregunta;

class PreguntaRepo{
	
	public static function formularios(){
		return Pregunta::formularios();
	}

	public static function getQuestionFromArea($areaName){
		return Pregunta::join('preguntas_formulario','preguntas_formulario.pregunta_id','=','preguntas.id')
						->join('formulario','formulario.id','=','preguntas_formulario.formulario_id')
						->where('formulario.nombre','=','CL-'.$areaName)
						->select('preguntas.texto as pregunta')
						->orderBy('preguntas.id','ASC')
						->get();
	}

}