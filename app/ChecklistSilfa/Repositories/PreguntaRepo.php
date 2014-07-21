<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\Pregunta;

class PreguntaRepo{
	
	public static function formularios(){
		return Pregunta::formularios();
	}

}