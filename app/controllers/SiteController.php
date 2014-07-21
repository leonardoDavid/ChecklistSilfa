<?php

use ChecklistSilfa\Libraries\Util;
use ChecklistSilfa\Repositories\ChecklistRepo;
use ChecklistSilfa\Repositories\UsuarioRepo;
use ChecklistSilfa\Repositories\TiendaRepo;

class SiteController extends BaseController {
    /*
	|--------------------------------------------------------------------------
	| Funciones del Sitio
	|--------------------------------------------------------------------------
	|
	| Estas funciones retornan las vistas de cada una de las paginas del 
	| sistema, cada una con sus correspondientes varibles (Menu, etc)
	|
	*/
    public function getDashboard(){
    	return View::make('Sitio.dashboard',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => Util::getMenu()
    		)),
            'Reportes' => ChecklistRepo::count(),
            'Users' => UsuarioRepo::count(),
            'Tiendas' => TiendaRepo::count()
    	));
    }

    /*
	|--------------------------------------------------------------------------
	| Notificacion de Bug
	|--------------------------------------------------------------------------
	|
	| Funcion encargada de enviar un mail al administrador del sistema
	|
	*/

    public function notifyBug(){
        if(Request::ajax()){
            $msj = Input::get('mensajes');
            $validations = Validator::make(
                array(
                    'mensaje' => $msj
                ),
                array(
                    'mensaje' => 'required|min:3'
                )
            );

            if($validations->fails()){
                $errors = array();
                foreach ($validations->messages()->all() as $mensaje){
                    array_push($errors, $mensaje);
                }
                
                $response = array(
                    'status' => false,
                    'motivos' => $errors,
                    'codigo' => 122
                );
            }
            else{
                $datos = array(
                    'template' => "emails.NotifyBug",
                    'info' => array(
                        'user' => Auth::user()->nombre." ".Auth::user()->ape_paterno,
                        'email' => Auth::user()->email,
                        'mensaje' => $msj
                    ),
                    'receptor' => array(
                        'email' => 'leo.david.mm@gmail.com',
                        'name' => 'Leonardo David',
                        'subject' => 'Notificacion de Bug'
                    )
                );
                $response = array(
                    'status' => Util::sendEmail($datos),
                    'motivo' => "Error en el envio",
                    'codigo' => 123
                );
            }
        }
        else{
            $response = array(
                'status' => false,
                'motivo' => "El request no es el correcto",
                'codigo' => 121
            );
        }           

        return $response;
    }

}
