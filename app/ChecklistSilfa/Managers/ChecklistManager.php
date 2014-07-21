<?php namespace ChecklistSilfa\Managers;

use ChecklistSilfa\Entities\Checklist;
use ChecklistSilfa\Entities\ChecklistDetalle;
use ChecklistSilfa\Libraries\Util;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChecklistManager{
	
	/*
    |--------------------------------------------------------------------------
    | Manager de Checklist
    |--------------------------------------------------------------------------
    |
    | Estas funciones son ituliozadas para agregar un nuevo checklist
    |
    */
    public static function save(){
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
            $checklist = new Checklist;
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

                $verifyEmail = Util::sendEmail($datos);
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

}