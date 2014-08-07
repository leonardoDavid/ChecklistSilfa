<?php

use ChecklistSilfa\Libraries\Util;
use ChecklistSilfa\Repositories\UsuarioRepo;
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
    		)),
    		'empleadosListTable' => UsuarioRepo::withOutMe()
    	));
	}

	public function adduser(){
		return UsuarioManager::adduser();
	}

	public function refreshUsers(){
        $response = array();
        $index = 0;
        $users = UsuarioRepo::withOutMe();
        foreach($users as $employed){
            $tmp = array(
                'name' => ucwords($employed->nombre),
                'lastname' => ucwords($employed->ape_paterno)." ".ucwords($employed->ape_materno),
                'email' => $employed->email,
                'active' => ($employed->estado == 1) ? "Activo" : "Deshabilitado",
                'checkbox' => "<input type='checkbox' class='flat-grey' name='employedIdOperating' value='".$employed->id."'>"
            );
            $response[$index] = $tmp;
            $index++;
        }
        return $response;
    }

    public function disabledUsers(){
    	if(Request::ajax()){
            $response = UsuarioManager::disabled();
        }
        else{
            $response = array(
                'status' => false,
                'motivo' => "Error en la solicitud"
            );
        }
        return $response;
    }

    public function enabledUsers(){
        if(Request::ajax()){
            $response = UsuarioManager::enabled();
        }
        else{
            $response = array(
                'status' => false,
                'motivo' => "Error en la solicitud"
            );
        }
        return $response;
    }
}