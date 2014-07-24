<?php

use ChecklistSilfa\Libraries\Util;
use ChecklistSilfa\Repositories\UsuarioRepo;

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
    		)),
    		'permisos' => $this->_getPermission()
    	));
	}

	private function _getPermission(){
		$items = UsuarioRepo::find(Auth::user()->id)->menus;
		$pemrission = "";
		foreach ($items as $row){
			switch ($row->url) {
				case '/':
					$pemrission .= "<li>Acceso al Dashboard</li>";
					break;
				case '/ingresar':
					$pemrission .= "<li>Ingresar Checklist</li>";
					break;
				case '/reportes':
					$pemrission .= "<li>Exportación de Reportes</li>";
					break;
				case '/admin':
					$pemrission .= "<li>Administración del Sistema</li>";
					break;
			}
		}
		return $pemrission;
	}

}