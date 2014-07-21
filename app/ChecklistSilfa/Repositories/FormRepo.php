<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\FormCheck;

class FormRepo{
	
	public static function preguntas(){
		return FormCheck::preguntas();
	}

	public static function find($id){
		return FormCheck::find($id);
	}

}