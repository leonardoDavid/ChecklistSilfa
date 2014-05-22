<?php
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
    	$MoreMenu = $this->_getMenu();
        $users = Usuario::where('estado','=','1')->count();
        $tiendas = Tienda::where('estado','=','1')->count();
        $reportes = ChecklistRepo::where('estado','=','1')->count();
    	return View::make('Sitio.dashboard',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => $MoreMenu
    		)),
            'Reportes' => $reportes,
            'Users' => $users,
            'Tiendas' => $tiendas
    	));
    }
    public function getSelectForm(){
    	$MoreMenu = $this->_getMenu();
    	$Areas = $this->_getAreas();
    	$Tiendas = $this->_getTiendas();

    	return View::make('Sitio.SelectForm',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => $MoreMenu
    		)),
    		'Areas'    => $Areas,
    		'Tiendas'    => $Tiendas
    	));
    }

    /*
	|--------------------------------------------------------------------------
	| Funciones Ajax
	|--------------------------------------------------------------------------
	|
	| Estas son funciones que responde a peticiones ajax realizadas por el sitio
	|
	*/
    public function ajaxSucursales(){
    	$response = $tmp = "";
    	if(Request::ajax()){
    		$value = Input::get('tienda');
    		if(is_numeric($value)){
	    		$items = Tienda::find($value)->sucursales;
	    		foreach ($items as $item){
		    		$tmp .= "<option value='".$item->id."'>".$item->nombre."</option>";
	    		}
	    		$response = array(
	    			'status' => true,
	    			'html'   => $tmp
	    		);
	    	}
	    	else
	    		$response = array(
	    			'status' => false,
	    			'motivo' => "La opción que selecciono no es valida",
	    			'codigo' => 101
	    		);
    	}
    	return $response;
    }    
    public function loadChecklist(){
    	$MoreMenu = $this->_getMenu();
    	$area = Input::get('area');
    	$tienda = Input::get('tienda');
    	$sucursal = Input::get('sucursal');

    	$validations = Validator::make(
    		array(
	    		'area' => $area,
	    		'tienda' => $tienda,
	    		'sucursal' => $sucursal
	    	),
	    	array(
    			'area' => 'required|integer',
    			'tienda' => 'required|integer',
    			'sucursal' => 'required|integer'
    		)
    	);

    	if($validations->fails()){
    		$mensajes = array();
    		foreach ($validations->messages()->all() as $mensaje){
		        array_push($mensajes, $mensaje);
    		}
    		return Redirect::to('ingresar')->with('resquest_error', json_encode($mensajes));
    	}
    	else{
    		$area = AreaType::find(Input::get('area'));
    		$tienda = Tienda::find(Input::get('tienda'));
    		$sucursal = SucursalPlace::find(Input::get('sucursal'));
	    	$form = FormCheck::find(Input::get('area'))->preguntas;

	    	$questions = "";
	    	foreach ($form as $question){
	    		if($question->id < 10)
	    			$hash = "0".$question->id;
	    		else
	    			$hash = $question->id;
	    		$questions .= View::make('Forms.Question',array(
	    			'Type' => $question->tipo,
	    			'ID' => $hash.md5($question->id.date("Ymdhis")),
	    			'Pregunta' => $question->texto,
	    			'CheckID' => md5($question->id.$question->texto.date("Ymd"))
	    		));
	    	}

	    	return View::make('Sitio.ChecklistForm',array(
	    		'MainMenu' => View::make('Menu.MainMenu',array(
	    			'MoreMenu' => $MoreMenu
	    		)),
	    		'Area' => $area->nombre,
	    		'AreaID' => $area->id,
	    		'Tienda' => $tienda->nombre,
	    		'TiendaID' => $tienda->id,
	    		'Sucursal' => $sucursal->nombre,
	    		'SucursalID' => $sucursal->id,
	    		'Form' => $questions,
	    		'Total' => count($form)
	    	));
	    }
    }
    public function saveChecklist(){
    	$datos = array();

    	if (Request::ajax()){

    		$datos = Input::get('valores');
    		$area = Input::get('area');
    		$sucursal = Input::get('sucursal');

    		if(count($datos) > 0 && is_numeric($area) && is_numeric($sucursal)){

    			//Se crea un nuevo registro de checklist
    			$checklist = new ChecklistRepo;
    			$checklist->area_id = $area;
    			$checklist->sucursal_id = $sucursal;
    			$checklist->user_id = Auth::user()->id;
    			$checklist->comentario = Input::get('final-comment');
    			$checklist->estado = 1;
    			try{
    				$checklist->save();
    				$status = true;
    			}
    			catch(Exception $e){
    				$status = false;
    			}

    			if($status){
    				//Guardando una a una las preguntas
    				$ides = "CHECKLIST:".$checklist->id."&&--";
	    			foreach ($datos as $answer){
	    				$resp = new ChecklistDetalle;
	    				$resp->checklist_id = $checklist->id;
	    				$resp->preguntas_form_id = (int)substr($answer['id'], 0,2);
	    				$resp->respuesta = $answer['valor'];
	    				$resp->comentario = $answer['comment'];
	    				$resp->estado = 1;

	    				try{
	    					$resp->save();
	    					$status = true;
	    					$ides .= $resp->id."#";
	    				}	
	    				catch(Exception $e){
	    					$status = false;
	    					break;
	    				}
	    			}

                    $datos = array(
                        'template' => "emails.NotifyChecklist",
                        'info' => array(
                            'user' => Auth::user()->nombre." ".Auth::user()->ape_paterno,
                            'email' => Auth::user()->email,
                            'ID' => "#".$checklist->id,
                            'dia' => date('d/m/Y'),
                            'hora' => date("h:m:s")
                        ),
                        'receptor' => array(
                            'email' => Auth::user()->email,
                            'name' => Auth::user()->nombre." ".Auth::user()->ape_paterno,
                            'subject' => 'Ingreso Exitoso'
                        )
                    );

                    $verifyEmail = $this->_sendEmail($datos);
                    if($verifyEmail && $status){
                        Session::push('save_success', 'Checklist guardado con éxito! (Se envio una copia a su correo)');
                        $response = array(
                            'status' => true
                        );
                    }
    				else if($status){
    					Session::push('save_success', 'Checklist guardado con éxito !');
    					$response = array(
		    				'status' => true
    					);
    				}
    				else{
    					$response = array(
			    			'status' => false,
			    			'motivo' => "Error al momento de almacenar la información",
			    			'codigo' => 114
			    		);
    				}
    			}
    			else{
    				$response = array(
		    			'status' => false,
		    			'motivo' => "Error al momento de almacenar la información",
		    			'codigo' => 113
		    		);
    			}
    		}
    		else{
    			$response = array(
	    			'status' => false,
	    			'motivo' => "Error en la recepción de datos",
	    			'codigo' => 112
	    		);
    		}
	    		
    	}
    	else{
    		$response = array(
    			'status' => false,
    			'motivo' => "Error en la Solicitud de Guardado",
    			'codigo' => 110
    		);
    	}

    	return json_encode($response);
    }
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
                    'motivo' => $errors,
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
                    'status' => $this->_sendEmail($datos),
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

    /*
	|--------------------------------------------------------------------------
	| Funciones Privadas
	|--------------------------------------------------------------------------
	|
	| Estas funciones son privadas y propias del Contralador, como lo son
	| obtner los items de un menu, etc
	|
	*/
    private function _getMenu(){
    	$response = "";
    	$items = Usuario::find(Auth::user()->id)->menus;
    	foreach ($items as $item){
    		$response .= View::make('Menu.Item',array(
    			'url' => $item->url,
    			'icon' => $item->icon,
    			'name' => $item->nombre
    		));
    	}
    	return $response;
    }
    private function _getAreas(){
    	$response = "";
    	$items = AreaType::where('estado','=','1')->get();
    	foreach ($items as $item){
    		$response .= "<option value='".$item->id."'>".utf8_encode($item->nombre)."</option>";
    	}
    	return $response;
    }
    private function _getTiendas(){
    	$response = "";
    	$items = Tienda::where('estado','=','1')->get();
    	foreach ($items as $item){
    		$response .= "<option value='".$item->id."'>".utf8_encode($item->nombre)."</option>";
    	}
    	return $response;
    }
    private function _sendEmail($datos){
        return Mail::queue($datos['template'], $datos['info'] , function($message) use($datos) {
            $message->to($datos['receptor']['email'], $datos['receptor']['name'])->subject($datos['receptor']['subject']);
        });
    }
}
