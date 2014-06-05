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
        $users = Usuario::where('estado','=','1')->count();
        $tiendas = Tienda::where('estado','=','1')->count();
        $reportes = ChecklistRepo::where('estado','=','1')->count();
    	return View::make('Sitio.dashboard',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => $this->_getMenu()
    		)),
            'Reportes' => $reportes,
            'Users' => $users,
            'Tiendas' => $tiendas
    	));
    }
    public function getSelectForm(){
    	$Areas = $this->_getAreas();
    	$Tiendas = $this->_getTiendas();

    	return View::make('Sitio.SelectForm',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => $this->_getMenu()
    		)),
    		'Areas'    => $Areas,
    		'Tiendas'    => $Tiendas
    	));
    }
    public function getSelectReport(){
        $areas = $tiendas = $sucursales = $usuarios = "";
        $area = AreaType::where('estado','=','1')->get()->toArray();
        $tienda = Tienda::where('estado','=','1')->get()->toArray();
        $usuario = Usuario::where('estado','=','1')->get()->toArray();

        //Extrallendo filtros si es que existen
        $filters = $this->_getFiltersReport();
        //Consultando registros filtrado
        $pages = $this->_listCheck($filters);
        
        //Recorriendo areas
        foreach ($area as $tmp){
            $selected = "";
            //Verifico si selecciono este valor en el filtro
            if(is_array($filters) && array_key_exists('area', $filters) && $tmp['id'] == $filters['area'])
                $selected = "selected";
            $areas .= "<option value=".$tmp['id']." ".$selected.">".$tmp['nombre']."</option>";
        }

        //Recorriendo las tiendas/locales
        foreach ($tienda as $tmp){
            $selected = "";
            //Verifico si selecciono este valor en el filtro
            if(is_array($filters) && array_key_exists('tienda', $filters) && $tmp['id'] == $filters['tienda'])
                $selected = "selected";
            $tiendas .= "<option value=".$tmp['id']." ".$selected.">".$tmp['nombre']."</option>";
        }

        //Recorriendo los usuarios
        foreach ($usuario as $tmp){
            $selected = "";
            //Verifico si selecciono este valor en el filtro
            if(is_array($filters) && array_key_exists('user', $filters) && $tmp['id'] == $filters['user'])
                $selected = "selected";
            $usuarios .= "<option value=".$tmp['id']." ".$selected.">".$tmp['nombre']." ".$tmp['ape_paterno']."</option>";
        }       

        return View::make('Sitio.SelectReport',array(
            'MainMenu' => View::make('Menu.MainMenu',array(
                'MoreMenu' => $this->_getMenu()
            )),
            'AreaOptions' => $areas,
            'LocalOptions' => $tiendas,
            'UserOptions' => $usuarios,
            'checklists' => $pages['files'],
            'links' => $pages['links']
        ));
    }
    public function getReport($id){
        try{
            //Desemcriptamos el parametro
            $idChecklist = Crypt::decrypt($id);
        }
        catch(Exception $e){
            //Si falla la desenciptacion retorno a los reportes con errores
            return Redirect::to('/reportes')->with('error-report',"Reporte no encontrado");
        }
        //Extrallendo info del checklist seleccionado
        $info = ChecklistRepo::infoReport($idChecklist)->get();
        $created = explode(" ",$info[0]->created_at);
        $fecha = explode("-", $created[0]);

        //Extrac del detalle del checklist
        $form = ChecklistDetalle::details($idChecklist)->get();
        $questions = "";
        $god = $wrong = $all = 0;
        foreach ($form as $question){
            if( ($question->tipo == "checkbox" && $question->respuesta == "1") || ($question->tipo == "text" && $question->respuesta != "") ){
                if($question->tipo == "checkbox" && $question->respuesta == "1")
                    $valor = "checked";
                else if($question->tipo == "text" && $question->respuesta != "")
                    $valor = $question->respuesta;
                else
                    $valor = "";
                if($question->isContable == 1)
                    $god++;
            }
            else{
                if($question->isContable == 1)
                    $wrong++;
                $valor = "";
            }
            if($question->comentario != "")
                $clase = "has-comment";
            else 
                $clase = "";
            $questions .= View::make('Forms.Result',array(
                'Type' => $question->tipo,
                'ID' => md5($question->id.date("Ymdhis")),
                'Pregunta' => $question->texto,
                'CheckID' => md5($question->texto.date("Ymd")),
                'Comentario' => $question->comentario,
                'Value' => $valor,
                'HasComment' => $clase
            ));
            if($question->isContable == 1)
                $all++;
        }

        return View::make('Sitio.DetailReport',array(
            'MainMenu' => View::make('Menu.MainMenu',array(
                'MoreMenu' => $this->_getMenu()
            )),
            'IDReport' => $idChecklist,
            'fechaIngreso' => $fecha[2]."-".$fecha[1]."-".$fecha[0],
            'horaIngreso' => $created[1],
            'evaluador' => $info[0]->user." ".$info[0]->last_name,
            'area' => $info[0]->area,
            'tienda' => $info[0]->local,
            'sucursal' => $info[0]->sucursal,
            'Form' => $questions,
            'comentario' => $info[0]->comentario,
            'Porcent' => round((100*$god)/$all)
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
        //Verifia que la peticion sea Ajax (HttpRequstXML o algo asi)
    	if(Request::ajax()){
    		$value = Input::get('tienda');

            $validations = Validator::make(
                array(
                    'tienda' => $value
                ),
                array(
                    'tienda' => 'required|numeric'
                )
            );

            if($validations->fails()){
                $response = array(
                    'status' => false,
                    'motivo' => "La opción que selecciono no es valida",
                    'codigo' => 101
                );
            }
    		else{
	    		$items = Tienda::find($value)->sucursales;
	    		foreach ($items as $item){
		    		$tmp .= "<option value='".$item->id."'>".$item->nombre."</option>";
	    		}
	    		$response = array(
	    			'status' => true,
	    			'html'   => $tmp
	    		);
	    	}
	    	
    	}
    	return $response;
    }    
    public function loadChecklist(){
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

	    	$form = $this->_loadForm(Input::get('area'));

	    	return View::make('Sitio.ChecklistForm',array(
	    		'MainMenu' => View::make('Menu.MainMenu',array(
	    			'MoreMenu' => $this->_getMenu()
	    		)),
	    		'Area' => $area->nombre,
	    		'AreaID' => $area->id,
	    		'Tienda' => $tienda->nombre,
	    		'TiendaID' => $tienda->id,
	    		'Sucursal' => $sucursal->nombre,
	    		'SucursalID' => $sucursal->id,
	    		'Form' => $form['questions'],
	    		'Total' => $form['count']
	    	));
	    }
    }
    public function saveChecklist(){
    	$datos = array();
        //Validamos que sea ajax
    	if (Request::ajax()){
    		$datos = Input::get('valores');
    		$area = Input::get('area');
    		$sucursal = Input::get('sucursal');

            $validations = Validator::make(
                array(
                    'datos' => count($datos),
                    'area'  => $area,
                    'sucursal' => $sucursal
                ),
                array(
                    'datos' => 'required|numeric|min:1',
                    'area' => 'required|numeric',
                    'sucursal' => 'required|numeric'
                )
            );

            if($validations->fails()){
                $response = array(
                    'status' => false,
                    'motivo' => "Error en la recepción de datos",
                    'codigo' => 112
                );
            }
    		else{
    			//Se crea un nuevo registro de checklist
    			$checklist = new ChecklistRepo;
    			$checklist->area_id = $area;
    			$checklist->sucursal_id = $sucursal;
    			$checklist->user_id = Auth::user()->id;
    			$checklist->comentario = Input::get('final-comment');
    			$checklist->estado = 1;
    			try{
                    //Guardando registro
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
                            //Aqui debiese enviarme un mail indicando la excepcion, viene en una prox entrega - comming soon xD
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
                    if($status){
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
        //Consulto los menus a los cuales el usuario logeado tiene acceso
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
        try{
            Mail::queue($datos['template'], $datos['info'] , function($message) use($datos) {
                $message->to($datos['receptor']['email'], $datos['receptor']['name'])->subject($datos['receptor']['subject']);
            });
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    private function _listCheck($filters = null){
        $files = "";
        if(is_null($filters))
            //Si no se enviaron filtros
            $list = ChecklistRepo::reports()->paginate(5);
        else
            //Si se enviaron filtro
            $list = ChecklistRepo::reports($filters)->paginate(5);

        foreach ($list as $row){
            //Sacando la fecha
            $fecha = explode(" ", $row->created_at);
            $fecha = explode("-", $fecha[0]);
            $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];

            //Creando la fila del reporte, se ecripta el id del checklist para luego hacerlo link (se envia con javascript)
            $files .= "<tr data-location='/reportes/".Crypt::encrypt($row->id)."'>";
            $files .= "<td>".$row->area."</td>";
            $files .= "<td>".$row->local."</td>";
            $files .= "<td>".$row->sucursal."</td>";
            $files .= "<td>".$row->user."</td>";
            $files .= "<td>".$fecha."</td>";
            $files .= "</tr>";
        }

        $response = array(
            'files' => $files,
            'links' => $list->links()
        );
        return $response;
    }
    private function _loadForm($area){
        //Trae las preguntas de cierta area
        $form = FormCheck::find($area)->preguntas;

        $questions = "";
        $count = 0;
        foreach ($form as $question){
            if($question->id < 10)
                $hash = "0".$question->id;
            else
                $hash = $question->id;
            $questions .= View::make('Forms.Question',array(
                'Type' => $question->tipo,
                'ID' => $hash.md5($question->id.date("Ymdhis")),
                'Pregunta' => $question->texto,
                'contable' => $question->isContable,
                'CheckID' => md5($question->id.$question->texto.date("Ymd"))
            ));
            if($question->isContable == 1)
                $count++;
        }

        return array(
            'questions' => $questions,
            'count' => $count
        );
    }
    private function _getFiltersReport(){
        //Evalua los filtros que vengan en un request post
        $filters = null;

        $area = Input::get('area',null);
        $user = Input::get('user',null);
        $tienda = Input::get('tienda',null);
        $sucursal = Input::get('sucursal',null);

        if($area != 0)
            $filters['area'] = $area;
        if($user != 0)
            $filters['user'] = $user;
        if($tienda != 0)
            $filters['tienda'] = $tienda;
        if($sucursal != 0)
            $filters['sucursal'] = $sucursal;

        return $filters;
    }
}
