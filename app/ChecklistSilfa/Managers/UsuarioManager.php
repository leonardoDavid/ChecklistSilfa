<?php namespace ChecklistSilfa\Managers;

use ChecklistSilfa\Entities\Usuario;
use ChecklistSilfa\Entities\Permisos;
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
    public static function update(){
        $validations = Validator::make(
            array(
                'Correo' => Input::get('email'),
                'Contraseña' => Input::get('password'),
                'Nombre' => Input::get('name'),
                'Apellido Paterno' => Input::get('paterno'),
                'Telefono Fijo' => Input::get('fijo'),
                'Telefono Movil' => Input::get('movil'),
                'Foto Perfil' => Input::file('photo')
            ),
            array(
                'Correo' => 'required|email|unique:user,email,'.Auth::user()->id,
                'Contraseña' => 'min:6',
                'Nombre' => 'required|min:3',
                'Apellido Paterno' => 'required|min:3',
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

    public static function adduser(){
        $response = array(
            'status' => false,
            'mensaje' => 'Proceso no ejecutado'
        );

        $validations = Validator::make(
            array(
                'Correo Electronico' => Input::get('email'),
                'Contraseña' => Input::get('password'),
                'Nombre' => Input::get('name'),
                'Apellido' => Input::get('paterno')
            ),
            array(
                'Correo Electronico' => 'required|email|unique:user,email',
                'Contraseña' => 'required|min:6',
                'Nombre' => 'required|min:3',
                'Apellido' => 'required|min:3'
            )
        );

        if($validations->fails()){
            $mensajes = "";
            foreach ($validations->messages()->all() as $mensaje){
                $mensajes .= "<li>".$mensaje."</li>";
            }
            return Redirect::to('admin')->with('error_request', 'Campos enviados eran invalidos')->with('error_mensajes',$mensajes);
        }
        else{
            $user = new Usuario;
            $user->email = Input::get('email');
            $user->nombre = Input::get('name');
            $user->password = Hash::make(Input::get('password'));
            $user->ape_paterno = Input::get('paterno');
            $user->estado = 1;            
            $user->username = UsuarioManager::generateUsername($user->nombre,$user->ape_paterno);

            try {
                $user->save();
            }catch (Exception $e){
                return Redirect::to('admin')->with('error_request','El usuario no pudo ser creado, proceso abortado');
            }

            $welcome = UsuarioManager::sendWelcome($user);
            if(UsuarioManager::assignAccess(Input::get('dashboard',null),Input::get('ingresar',null),Input::get('reportes',null),Input::get('admin',null),Input::get('lista',null),$user->id)){
                if($welcome)
                    return Redirect::to('admin')->with('success_request','Usuario agregado con exito!');
                else
                    return Redirect::to('admin')->with('warning_request','Usuario agregado con exito! <strong>No se pudo enviar un email de bienvenida</strong>');
            }
            else{
                if($welcome)
                    return Redirect::to('admin')->with('warning_request','Se creo el usuario pero no se asignaron todos los permisos');
                else
                    return Redirect::to('admin')->with('warning_request','Se creo el usuario pero no se asignaron todos los permisos ni se envio el email de bienvenida');
            }

        }
    }

    public static function generateUsername($nombre,$apellido){
        $nombre = strtolower($nombre);
        $apellido = strtolower($apellido);

        $option = 1;
        $largo = strlen($nombre);
        $posicion = 3;
        $name = null;

        while(true){
            switch ($option) {
                case 1:
                case 2:
                case 3:
                    $name = substr($nombre,0,$option).$apellido;
                    break;
                case 4:
                    if($posicion <= $largo){
                        $name = substr($nombre,0,$posicion).$apellido;
                    }
                    else{
                        $option++;
                        $posicion = 1;
                        $largo = strlen($apellido);
                    }
                    break;
                case 6:
                    if($posicion <= $largo){
                        $name = $nombre.substr($apellido,0,$posicion);
                    }
                    else
                        $option++;
                    break;
            }
            $validations = Validator::make(
                array(
                    'name' => $name
                ),
                array(
                    'name' => 'unique:user,username',
                )
            );

            if($validations->fails()){
                if($option == 7)
                    break;
                else if($option != 4 && $option != 6)
                    $option++;
                else
                    $posicion++;
            }
            else
                break;
        }

        return $name;
    }

    public static function assignAccess($dashboard = null,$ingresar = null,$reportes = null,$admin = null,$lista = null,$user = null){
        $status = true;

        if(!is_null($user)){
            if(!is_null($dashboard)){
                if($dashboard == "on" || $dashboard == "yes" || $dashboard == 1){
                    $permiso = new Permisos;
                    $permiso->user_id = $user;
                    $permiso->permisos_id = 1;
                    try{
                        $permiso->save();
                    }catch (Exception $e){
                        $status = false;
                    }
                }
            }
            if(!is_null($ingresar)){
                if($ingresar == "on" || $ingresar == "yes" || $ingresar == 1){
                    $permiso = new Permisos;
                    $permiso->user_id = $user;
                    $permiso->permisos_id = 2;
                    try{
                        $permiso->save();
                    }catch (Exception $e){
                        $status = false;
                    }
                }
            }
            if(!is_null($reportes)){
                if($reportes == "on" || $reportes == "yes" || $reportes == 1){
                    $permiso = new Permisos;
                    $permiso->user_id = $user;
                    $permiso->permisos_id = 3;
                    try{
                        $permiso->save();
                    }catch (Exception $e){
                        $status = false;
                    }
                }
            }
            if(!is_null($lista)){
                if($lista == "on" || $lista == "yes" || $lista == 1){
                    $permiso = new Permisos;
                    $permiso->user_id = $user;
                    $permiso->permisos_id = 4;
                    try{
                        $permiso->save();
                    }catch (Exception $e){
                        $status = false;
                    }
                }
            }
            if(!is_null($admin)){
                if($admin == "on" || $admin == "yes" || $admin == 1){
                    $permiso = new Permisos;
                    $permiso->user_id = $user;
                    $permiso->permisos_id = 5;
                    try{
                        $permiso->save();
                    }catch (Exception $e){
                        $status = false;
                    }
                }
            }
        }
        else
            $status = false;

        return $status;
    }

    public static function sendWelcome($user){
        $datos = array(
            'template' => "emails.WelcomeSystem",
            'info' => array(
                'user' => $user->nombre." ".$user->ape_paterno,
                'username' => $user->username,
                'email' => $user->email,
                'password' => Input::get('password')
            ),
            'receptor' => array(
                'email' => $user->email,
                'name' => 'Sistema de Checklist',
                'subject' => 'Bienvenido a Checklist System'
            )
        );
        return Util::sendEmail($datos);
    }

    public static function enabled($disabled=null){
        $ids = explode(",", Input::get('ids'));
        $pased = true;
        $idsEnabled = array();
        foreach ($ids as $employ){

            $validation = Validator::make(
                array(
                    'usuario' => $employ
                ),
                array(
                    'usuario' => 'required|exists:user,id'
                )
            );

            if($validation->fails()){
                $pased = false;
                break;
            }
            else{
                array_push($idsEnabled, $employ);
            }
        }

        if($pased){
            foreach ($idsEnabled as $id){
                $empleado = Usuario::find($id);
                $empleado->estado = (is_null($disabled)) ? 1 : 0;
                try {
                    $empleado->save();
                    $status = true;
                }catch (Exception $e) {
                    $status = false;
                    $response = array(
                        'status' => false,
                        'motivo' => "Interrupción en el proceso de actualización",
                        'execption' => $e->getMessage()
                    );
                }
                if($status){
                    $response = array(
                        'status' => true
                    );
                }
            }
        }
        else{
            $response = array(
                'status' => false,
                'motivo' => "Hay usuarios no registrados en el sistema, imposible actualizar"
            );            
        }

        return $response;
    }

    public static function disabled(){
        return UsuarioManager::enabled(1);
    }

}