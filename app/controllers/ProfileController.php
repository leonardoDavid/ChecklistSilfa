<?php

use ChecklistSilfa\Libraries\Util;
use ChecklistSilfa\Repositories\UsuarioRepo;
use ChecklistSilfa\Managers\UsuarioManager;

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

	public function saveProfile(){
		if(UsuarioManager::save())
			return Redirect::to('perfil')->with('success_chage', 'Prefil actualizado :)');
		else
			return Redirect::to('perfil')->with('error_chage', 'No se puedo actualizar los datos, intentelo más tarde');
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