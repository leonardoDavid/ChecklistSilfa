<?php
class MainMenu extends Eloquent{

	protected $table = 'menu';
	protected $primaryKey = 'id';

	public function users(){
        return $this->belongsToMany('Usuario', 'permisos_menu', 'user_id', 'permisos_id')->where('user','=','1');
    }

}
