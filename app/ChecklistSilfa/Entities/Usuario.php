<?php namespace ChecklistSilfa\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	protected $table = 'user';
	protected $hidden = array('password', 'remember_token');

	//Consulta los menus a los cuales el usuario tiene permisos
	public function menus(){
        return $this->belongsToMany('ChecklistSilfa\Entities\MainMenu', 'permisos_menu', 'user_id', 'permisos_id')->where('menu.estado','=','1')->orderBy('menu.id');
    }

}
