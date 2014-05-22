<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'user';
	protected $hidden = array('password');

	public function getAuthIdentifier(){
		return $this->getKey();
	}

	public function getAuthPassword(){
		return $this->password;
	}

	public function getRememberToken(){
		return $this->remember_token;
	}

	public function setRememberToken($value){
		$this->remember_token = $value;
	}

	public function getRememberTokenName(){
		return 'remember_token';
	}

	public function getReminderEmail(){
		return $this->email;
	}

	public function menus(){
        return $this->belongsToMany('MainMenu', 'permisos_menu', 'user_id', 'permisos_id')->where('menu.estado','=','1')->orderBy('menu.id');
    }

}
