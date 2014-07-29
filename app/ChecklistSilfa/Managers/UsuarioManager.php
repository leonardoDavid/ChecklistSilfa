<?php namespace ChecklistSilfa\Managers;

use ChecklistSilfa\Entities\Usuario;
use ChecklistSilfa\Libraries\Util;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UsuarioManager{
	
	/*
    |--------------------------------------------------------------------------
    | Manager de Usuario
    |--------------------------------------------------------------------------
    |
    | Estas funciones son utilizadas para actualizar o guardar usuaios
    |
    */
    public static function save(){
        $validations = Validator::make(
            array(
                'Correo' => Input::get('email'),
                'password' => Input::get('password'),
                'Nombre' => Input::get('name'),
                'Apellido Paterno' => Input::get('paterno'),
                'Telefono Fijo' => Input::get('fijo'),
                'Telefono Movil' => Input::get('movil'),
                'Foto Perfil' => Input::file('photo')
            ),
            array(
                'Correo' => 'required|email|unique:user,email,'.Auth::user()->id,
                'password' => 'min:6',
                'Nombre' => 'required',
                'Apellido Paterno' => 'required',
                'Telefono Fijo' => 'numeric',
                'Telefono Movil' => 'numeric',
                'Foto Perfil' => 'mimes:jpeg,jpg,png'
            )
        );

        if($validations->fails()){
            $mensajes = "";
            foreach ($validations->messages()->all() as $mensaje){
                $mensajes .= "<li>".$mensaje."</li>";
            }
            return Redirect::to('perfil')->with('error_chage', 'Campos enviados eran invalidos')->with('error_mensajes',$mensajes);
        }
        else{
            $user = Usuario::find(Auth::user()->id);

            if(Input::has('email'))
                $user->email = Input::get('email');
            if(Input::has('password'))
                $user->password = Hash::make(Input::get('password'));
            if(Input::has('name'))
                $user->nombre = Input::get('name');
            if(Input::has('paterno'))
                $user->ape_paterno = Input::get('paterno');
            if(Input::has('materno'))
                $user->ape_materno = Input::get('materno');
            if(Input::has('fijo'))
                $user->tel_fijo = Input::get('fijo');
            if(Input::has('movil'))
                $user->tel_movil = Input::get('movil');

            try{
                if(Input::file('photo')){
                    $file = Input::file('photo');
                    $destinationPath = app_path().'/ChecklistSilfa/Files/Images/Profile';
                    if(File::exists($destinationPath) && File::isWritable($destinationPath)){
                        $filename = Auth::user()->username;
                        $filename .= ($file->getClientOriginalExtension() == 'jpeg') ? '.jpg' : '.'.$file->getClientOriginalExtension();
                        $uploadSuccess = $file->move($destinationPath, $filename);
                 
                        if(!$uploadSuccess)
                            return false;
                    }
                    else
                        return false;
                }

                $user->save();
                return true;
            }
            catch(Exception $e){
                return false;
            }
        }
    }

}