<?php

use ChecklistSilfa\Libraries\Util;

class ProfileController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Funciones de informacion
	|--------------------------------------------------------------------------
	|
	| Estas funciones retornan lainformacion del usuario segun sea lo que
	| este haya requerido mediante la url
	|
	*/
	public function getProfile(){
    	return View::make('Perfil.dashboard',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => Util::getMenu()
    		))
    	));
	}

}