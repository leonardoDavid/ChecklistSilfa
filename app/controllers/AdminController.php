<?php

use ChecklistSilfa\Libraries\Util;
use ChecklistSilfa\Managers\UsuarioManager;

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Funciones de informacion
	|--------------------------------------------------------------------------
	|
	| Estas funciones retornan lainformacion del usuario segun sea lo que
	| este haya requerido mediante la url
	|
	*/
	public function getDashboard(){
    	return View::make('Administration.dashboard',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => Util::getMenu()
    		))
    	));
	}

	public function adduser(){
		return UsuarioManager::adduser();
	}
}