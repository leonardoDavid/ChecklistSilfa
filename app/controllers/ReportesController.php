<?php

use ChecklistSilfa\Libraries\Util;
use ChecklistSilfa\Repositories\AreaRepo;
use ChecklistSilfa\Repositories\TiendaRepo;
use ChecklistSilfa\Repositories\UsuarioRepo;
use ChecklistSilfa\Repositories\ChecklistRepo;

class ReportesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Funciones de Reportes
	|--------------------------------------------------------------------------
	|
	| Estas funciones tienen que controlar todo lo que sucede en el proceso
	| de reportes y exportacion de datos del sistema.
	|
	*/

	public function getSelectReport(){
        $areas = $tiendas = $sucursales = $usuarios = "";
        $area = AreaRepo::all()->toArray();
        $tienda = TiendaRepo::all()->toArray();
        $usuario = UsuarioRepo::all()->toArray();

        $filters = $this->_getFiltersReport();
        $pages = $this->_listCheck($filters);
        
        foreach ($area as $tmp){
            $selected = "";
            if(is_array($filters) && array_key_exists('area', $filters) && $tmp['id'] == $filters['area'])
                $selected = "selected";
            $areas .= "<option value=".$tmp['id']." ".$selected.">".$tmp['nombre']."</option>";
        }

        foreach ($tienda as $tmp){
            $selected = "";
            if(is_array($filters) && array_key_exists('tienda', $filters) && $tmp['id'] == $filters['tienda'])
                $selected = "selected";
            $tiendas .= "<option value=".$tmp['id']." ".$selected.">".$tmp['nombre']."</option>";
        }

        foreach ($usuario as $tmp){
            $selected = "";
            if(is_array($filters) && array_key_exists('user', $filters) && $tmp['id'] == $filters['user'])
                $selected = "selected";
            $usuarios .= "<option value=".$tmp['id']." ".$selected.">".$tmp['nombre']." ".$tmp['ape_paterno']."</option>";
        }       

        return View::make('Reportes.SelectReport',array(
            'MainMenu' => View::make('Menu.MainMenu',array(
                'MoreMenu' => Util::getMenu()
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
            $idChecklist = Crypt::decrypt($id);
        }
        catch(Exception $e){
            return Redirect::to('/reportes')->with('error-report',"Reporte no encontrado");
        }

        $info = ChecklistRepo::infoReport($idChecklist)->get();
        $created = explode(" ",$info[0]->created_at);
        $fecha = explode("-", $created[0]);


        $form = ChecklistRepo::details($idChecklist)->get();
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

        return View::make('Reportes.DetailReport',array(
            'MainMenu' => View::make('Menu.MainMenu',array(
                'MoreMenu' => Util::getMenu()
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

    public function exportReport($action,$id = null){
        switch ($action) {
            case 'lista':
                if(Input::has('datos')){
                    $datos = Input::get('datos');
                    $datos['ext'] = 'csv';
                    $datos['model'] = 'lista';
                    $response = $this->generateFileReport($datos);
                }
                else{
                    $response = array(
                        'status' => false,
                        'motivo' => "No se enviaron datos para exportar"
                    );
                }
                break;
            case 'id':
                # code...
                break;
            case 'all':
                # code...
                break;
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

    private function _listCheck($filters = null){
        $files = "";

        $list = (is_null($filters)) ? ChecklistRepo::reports()->paginate(5) : ChecklistRepo::reports($filters)->paginate(5);

        if(count($list) > 0){
            foreach ($list as $row){
                $fecha = explode(" ", $row->created_at);
                $fecha = explode("-", $fecha[0]);
                $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];

                $files .= "<tr data-location='/reportes/".Crypt::encrypt($row->id)."'>";
                $files .= "<td data-area='".$row->area."'>".$row->area."</td>";
                $files .= "<td data-tienda='".$row->local."'>".$row->local."</td>";
                $files .= "<td data-sucursal='".$row->sucursal."'>".$row->sucursal."</td>";
                $files .= "<td data-user='".$row->user." ".$row->apellido."'>".$row->user." ".$row->apellido."</td>";
                $files .= "<td data-fecha='".$fecha."'>".$fecha."</td>";
                $files .= "</tr>";
            }
        }
        else
            $files = "<tr data-location='/reportes'><td colspan='5'>No se encontraron Checklist</td><tr/>";

        $response = array(
            'files' => $files,
            'links' => $list->links()
        );
        return $response;
    }

    private function _getFiltersReport(){
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

    public function getFileReport($hashName){
        $fileName = Crypt::decrypt($hashName);
        $fileLocation = app_path().'/ChecklistSilfa/Files/Reports/'.$fileName.".csv";
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

    private function generateFileReport($data){
        $response = array();
        $headersCSV = array();

        if($data['model'] == "lista"){
            array_push($headersCSV, 'Area');
            array_push($headersCSV, 'Tienda');
            array_push($headersCSV, 'Sucursal');
            array_push($headersCSV, 'Supervisor');
            array_push($headersCSV, 'Fecha');
            array_push($headersCSV, 'ID Checklist');
        }

        if(count($data) > 0){
            try{
                $fileName = date('d-m-Y_H:i:s')."_By-".Auth::user()->username."_".$data['model'];
                $fileLocation = app_path().'/ChecklistSilfa/Files/Reports/'.$fileName.".csv";
                $file = fopen( $fileLocation, 'w');
                fputcsv($file, $headersCSV);

                foreach ($data as $row){
                    $tmp = array();
                    if($data['model'] == "lista"){
                        if(is_array($row)){
                            array_push($tmp, $row['area']);
                            array_push($tmp,$row['tienda']);
                            array_push($tmp,$row['sucursal']);
                            array_push($tmp,$row['supervisor']);
                            array_push($tmp,$row['fecha']);
                            $ruta = explode("/", $row['ruta']);
                            array_push($tmp,Crypt::decrypt($ruta[2]));
                        }
                    }
                    fputcsv($file, $tmp);
                }
                fclose($file);

                switch ($data['model']) {
                    case 'lista':
                        $route = 'reportes';
                        break;   
                    default:
                        $route = $data['model'];
                        break;
                }

                $response = array(
                    'status' => true
                );
            }catch(Exception $e){
                $response = array(
                    'status' => false,
                    'motivo' => "Error al tratar de Generar el Reporte",
                    'exception' => $e->getMessage()
                );
            }
        }
        else
            $response = array(
                'status' => false,
                'motivo' => "No existen registros asociados",
                'exception' => 'No Data Found'
            );

        return $response;
    }

}