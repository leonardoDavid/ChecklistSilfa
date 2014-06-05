<?php
/*
|--------------------------------------------------------------------------
| Controlador de la autenticación de usuarios
|--------------------------------------------------------------------------
*/
class AuthController extends BaseController {
    /**
     * Muestra el formulario para login.
     */
    public function showLogin(){
        // Verificamos que el usuario no esté logeado
        if (Auth::check()){
            // Se redirecciona al dashboard si esta logeado
            return Redirect::to('/');
        }
        //Retorna Vistas de login en caso de no estar logeado
        return View::make('login');
    }

    /**
     * Valida los datos del usuario.
     */
    public function postLogin(){
        // Guardamos en un arreglo los datos del usuario a validar
        $loginWithUser = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'estado'   => '1'
        );
        $loginWithEmail = array(
            'email' => Input::get('username'),
            'password' => Input::get('password'),
            'estado'   => '1'
        );
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        //Pruebo login con nombre de usuario
        if(Auth::attempt( $loginWithUser , Input::get('remember', 0) )){
            return Redirect::to('/');
        }
        //Pruebo login con email
        else if(Auth::attempt( $loginWithEmail , Input::get('remember', 0) )){
            return Redirect::to('/');
        }
        // Retornar con withInput() para retornar el valor de los inputs
        //Redireccciona al login pero con errores
        return Redirect::to('login')
            ->with('error_login', 'Tus datos son incorrectos o estas deshabilitado');
    }

    /**
     * Muestra el formulario de login mostrando un mensaje de que cerró sesión.
     */
    public function logOut()
    {
        Auth::logout();
        return Redirect::to('login')
            ->with('info_login', 'Tu sesión ha sido cerrada.');
    }
}
