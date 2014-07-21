<?php
/*
|--------------------------------------------------------------------------
| Controlador de la autenticación de usuarios
|--------------------------------------------------------------------------
*/
class AuthController extends BaseController {

    public function showLogin(){
        if (Auth::check()){
            return Redirect::to('/');
        }
        return View::make('login');
    }

    public function postLogin(){
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
        if(Auth::attempt( $loginWithUser , Input::get('remember', 0) )){
            return Redirect::to('/');
        }
        else if(Auth::attempt( $loginWithEmail , Input::get('remember', 0) )){
            return Redirect::to('/');
        }
        return Redirect::to('login')
            ->with('error_login', 'Tus datos son incorrectos o estas deshabilitado');
    }

    public function logOut(){
        Auth::logout();
        return Redirect::to('login')
            ->with('info_login', 'Tu sesión ha sido cerrada.');
    }
}
