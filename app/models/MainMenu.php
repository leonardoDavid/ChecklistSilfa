<?php
class MainMenu extends Eloquent{

	protected $table = 'menu';
	protected $primaryKey = 'id';

	//Realcion muchos a muchos, consulta una tabla intermedia para traer los permisos del usuario
	public function users(){
        return $this->belongsToMany('Usuario', 'permisos_menu', 'user_id', 'permisos_id')->where('user','=','1');
    }

}
