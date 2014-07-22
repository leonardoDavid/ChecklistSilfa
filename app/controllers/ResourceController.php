<?php

use ChecklistSilfa\Libraries\Util;

class ResourceController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Funciones de Resources
	|--------------------------------------------------------------------------
	|
	| Este controlador genera y retorna los archivos staticos dependiendo de
	| ciertos filtros predefinidos.
	|
	*/

    public function getResource($resource,$typeOrName = null,$name = null){
        if($resource == "images")
            return $this->_getImage($typeOrName,$name);
        else
            return App::abort(404);
    }

    /*
	|--------------------------------------------------------------------------
	| Funciones Privadas
	|--------------------------------------------------------------------------
	|
	| Estas funciones son privadas y propias del Contralador, como lo son
	| generar el mime del archivo, set headers, etc.
	|
	*/

    private function _getImage($typeOrName,$name){
        if($typeOrName == "profile"){
            $filename = Auth::user()->username;
            $fileLocation = app_path().'/ChecklistSilfa/Files/Images/Profile/'.$filename.".jpg";
        }
        else{
            if(is_null($name))
                return App::abort(404);
            $filename = Crypt::decrypt($name);
            $fileLocation = app_path().'/ChecklistSilfa/Files/'.ucwords($typeOrName).'/'.$filename.".jpg";
        }

        if(file_exists($fileLocation)){
            $resource = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($resource , $fileLocation);
            finfo_close($resource);

            $partes = explode('.', $fileLocation);
            $total = count($partes);
            $ext = ($total > 0) ? $partes[$total -1] : 'txt';

            $headers = array(
                'Content-Type' => $type,
                'Content-Disposition' => 'attachment; filename=reporte.'.$ext,
            );
            return Response::make(readfile($fileLocation), 200, $headers);
        }
        else
            return App::abort(404);
    }

}