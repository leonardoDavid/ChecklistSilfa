<?php
/*
|--------------------------------------------------------------------------
| Controlador de la Carga de las paginas del sitio, todo con los respectivos
| permisos que tiene cada usuario para visualizar el contenido
|--------------------------------------------------------------------------
*/
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
    	return View::make('Sitio.dashboard',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => $MoreMenu
    		))
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
	    		$questions .= View::make('Forms.Question',array(
	    			'Type' => $question->tipo,
	    			'ID' => $question->id,
	    			'Pregunta' => $question->texto,
	    			'CheckID' => md5($question->id.$question->texto.date("Ymd"))
	    		));
	    	}

	    	return View::make('Sitio.ChecklistForm',array(
	    		'MainMenu' => View::make('Menu.MainMenu',array(
	    			'MoreMenu' => $MoreMenu
	    		)),
	    		'Area' => $area->nombre,
	    		'Tienda' => $tienda->nombre,
	    		'Sucursal' => $sucursal->nombre,
	    		'Form' => $questions
	    	));
	    }
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
}
