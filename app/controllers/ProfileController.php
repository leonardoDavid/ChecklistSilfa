<?php
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
		$MoreMenu = $this->_getMenu();
    	return View::make('Perfil.dashboard',array(
    		'MainMenu' => View::make('Menu.MainMenu',array(
    			'MoreMenu' => $MoreMenu
    		))
    	));
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

}