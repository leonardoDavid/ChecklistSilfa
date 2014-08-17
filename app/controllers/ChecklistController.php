<?php

use ChecklistSilfa\Libraries\Util;
use ChecklistSilfa\Repositories\AreaRepo;
use ChecklistSilfa\Repositories\TiendaRepo;
use ChecklistSilfa\Repositories\SucursalRepo;
use ChecklistSilfa\Repositories\FormRepo;
use ChecklistSilfa\Managers\ChecklistManager;

class ChecklistController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Funciones de Checklist
	|--------------------------------------------------------------------------
	|
	| Estas funciones tienen que controlar todo lo que sucede en el proceso
	| de ingreso de un checklist en el sistema
	|
	*/

	public function getSelectForm(){
    	return View::make('Checklist.SelectForm',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => Util::getMenu()
    		)),
    		'Areas'    => Util::getSelectAreas(),
    		'Tiendas'    => Util::getSelectTiendas()
    	));
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
    		$area = AreaRepo::find(Input::get('area'));
    		$tienda = TiendaRepo::find(Input::get('tienda'));
    		$sucursal = SucursalRepo::find(Input::get('sucursal'));

	    	$form = $this->_loadForm(Input::get('area'));

	    	return View::make('Checklist.ChecklistForm',array(
	    		'MainMenu' => View::make('Menu.MainMenu',array(
	    			'MoreMenu' => Util::getMenu()
	    		)),
	    		'Area' => $area->nombre,
	    		'AreaID' => $area->id,
	    		'Tienda' => $tienda->nombre,
	    		'TiendaID' => $tienda->id,
	    		'Sucursal' => $sucursal->nombre,
	    		'SucursalID' => $sucursal->id,
	    		'Form' => $form['questions']
	    	));
	    }
    }

    public function getSelectSucusales(){
    	if(Request::ajax()){
    		$response = Util::getSelectSucursales();
    	}
    	else{
    		$response = array(
    			'status' => false,
    			'motivo' => "Error en la Solicitud"
    		);
    	}
    	return $response;
    }

    public function saveChecklist(){
    	$datos = array();
    	if (Request::ajax()){
    		$response = ChecklistManager::save();
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

    private function _loadForm($area){
        $form = FormRepo::find($area)->preguntas;

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
                'contable' => $question->ponderacion,
                'CheckID' => md5($question->id.$question->texto.date("Ymd"))
            ));
        }

        return array(
            'questions' => $questions
        );
    }

}