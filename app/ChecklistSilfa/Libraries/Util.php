<?php namespace ChecklistSilfa\Libraries;

use ChecklistSilfa\Repositories\UsuarioRepo;
use ChecklistSilfa\Repositories\AreaRepo;
use ChecklistSilfa\Repositories\TiendaRepo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class Util{
	
	/*
	|--------------------------------------------------------------------------
	| Funciones Comunes
	|--------------------------------------------------------------------------
	|
	| Estas funciones son comunes entre todos los controladores o modelos, ya
	| entregan informacion general independiente de quien los llame
	|
	*/

	public static function getMenu(){
		$response = "";
    	$items = UsuarioRepo::find(Auth::user()->id)->menus;
    	foreach ($items as $item){
    		$response .= View::make('Menu.Item',array(
    			'url' => $item->url,
    			'icon' => $item->icon,
    			'name' => $item->nombre
    		));
    	}
    	return $response;
	}

	public static function getSelectAreas(){
    	$response = "";
    	$items = AreaRepo::all();
    	foreach ($items as $item){
    		$response .= "<option value='".$item->id."'>".utf8_encode($item->nombre)."</option>";
    	}
    	return $response;
    }

    public static function getSelectTiendas(){
    	$response = "";
    	$items = TiendaRepo::all();
    	foreach ($items as $item){
    		$response .= "<option value='".$item->id."'>".utf8_encode($item->nombre)."</option>";
    	}
    	return $response;
    }

    public static function getSelectSucursales(){
    	$response = $tmp = "";
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
    		$items = TiendaRepo::find($value)->sucursales;
    		foreach ($items as $item){
	    		$tmp .= "<option value='".$item->id."'>".$item->nombre."</option>";
    		}
    		$response = array(
    			'status' => true,
    			'html'   => $tmp
    		);
    	}

    	return $response;
    }

    public static function sendEmail($datos){
        try{
            Mail::queue($datos['template'], $datos['info'] , function($message) use($datos) {
                $message->to($datos['receptor']['email'], $datos['receptor']['name'])->subject($datos['receptor']['subject']);
                if(array_key_exists('reporte', $datos))
                    $message->attach($datos['reporte']);                
                if(array_key_exists('cc', $datos['receptor']) && is_array($datos['receptor']['cc']) && count($datos['receptor']['cc']) > 0 ){
                    foreach ($datos['receptor']['cc'] as $copia){
                        $message->cc($copia);
                    }
                }                
            });
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

}